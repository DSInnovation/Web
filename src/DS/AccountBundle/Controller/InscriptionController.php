<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use DS\AccountBundle\Entity\webAccount;
use DS\AccountBundle\Entity\webActivate;

class InscriptionController extends Controller
{
    /**
     * Create inscription form
     * @return form
     */
    private function createFormInscription()
    {
        $form = $this->createFormBuilder()
                ->add('login', 'text', array(
                    'label' => 'Nom de compte : '
                ))
                ->add('password', 'password', array (
                    'label' => 'Mot de passe : '
                ))
                ->add('passwordverif', 'password', array (
                    'label' => 'Répéter Mot de passe : '
                ))
                ->add('email', 'email' , array (
                    'label' => 'Adresse mail : '
                ))
                ->add('submit', 'submit', array (
                    'label' => 'S\'inscrire'
                ))
                ->getForm();
        
        return $form;
    }
    
    /**
     * Return if login exist or not
     * @param type $login
     * @return bool
     */
    private function checkLoginFree(&$form, $em)
    {
        $accountRepo = $em->getRepository('DSAccountBundle:webAccount');
        
        $existUserLogin = $accountRepo->findOneBy(array('login' => $form->get('login')->getData()));
        if($existUserLogin) {
            $form->addError(new FormError('Le login est déjà prit !'));
        }
    }
    
    /**
     * Check if password = passwordverif
     * If it's not then add a FormError
     * 
     * @param form $form
     */
    private function checkPassword(&$form)
    {   
        if($form->get('password')->getData() != $form->get('passwordverif')->getData()) {
            $form->addError(new FormError('Les mots de passes différent !'));
        }
    }
    
    /**
     * check if the mail exist in the table appClient
     * if he exist then return the id of the line in the table
     * 
     * @param form $form
     * @param manager $em
     * @return int
     */
    private function checkEmail(&$form, $em)
    {
        $clientRepo = $em->getRepository('DSAccountBundle:appClient');
        
        $existClient = $clientRepo->findOneBy(array('email' => $form->get('email')->getData()));
        if(!$existClient) {
            $form->addError(new FormError('L\'adresse mail n\'existe pas'));
        }
        
        return $existClient->getId();
    }
    
    /**
     * Check if an account is waiting for a validation
     * If account is waiting for the id then add a FormError
     * 
     * @param form $form
     * @param manager $em
     * @param int $idClient
     */
    private function checkAccountWaitingValidate(&$form, $em, $idClient)
    {
        $repository = $em->getRepository('DSAccountBundle:webActivate');
        $existUserMail = $repository->findOneBy(array('id' => $idClient));
        if($existUserMail) {
            $form->addError(new FormError('Un compte est déjà en attente de validation !'));
        }
    }
    
    /**
     * Check if mail is not use by a webAccount
     * If someone does then add a FormError
     * 
     * @param form $form
     * @param manager $em
     * @param int $idClient
     */
    private function checkUserUseIdClient(&$form, $em, $idClient)
    {
        $repository = $em->getRepository('DSAccountBundle:webAccount');
        $existIdClient = $repository->findOneBy(array('idClient' => $idClient));
        if($existIdClient) {
            $form->addError(new FormError('Un compte est déjà lié au client !'));
        }
    }
    
    /**
     * Check all the informations are valid
     * If it's true then persist DataBase
     * 
     * @param form $form
     * @return form
     */
    public function inscrireUser($form)
    {
        $em = $this->getDoctrine()->getManager();
        $idClient = $this->checkEmail($form, $em);
        $this->checkUserUseIdClient($form, $em, $idClient);
        $this->checkAccountWaitingValidate($form, $em, $idClient);
        $this->checkLoginFree($form, $em);
        $this->checkPassword($form);
        
        if(!$form->getErrorsAsString()) {     
            $user = new webAccount();
            $user->setActivate(0);
            $user->setIdClient($idClient);
            $user->setLogin($form->get('login')->getData());
            $user->setPassword($form->get('password')->getData());
            $em->persist($user);
            $em->flush();
            
            $validate = new webActivate();
            $validate->setIdWebAccount($user->getId());
            $validate->setUrl('test');
            $em->persist($validate);
            
            $em->flush();
        }
        return array('form' => $form);
    }
    
    /**
     * @Route(path="/inscription", name="inscription")
     * @Template()
     */
    public function inscriptionAction(Request $request)
    {
        $session = $request->getSession();
        
        if($session->get('id')) {
            return $this->redirect($this->generateUrl("index"));
        }
        
        $form = $this->createFormInscription();
        
        if(!$request->isMethod('post')) {
            return array('form' => $form->createView());
        }
        
        $form->handleRequest($request);
        
        if(!$form->isValid()) {
            return array('form' => $form->createView());
        }
        
        $this->inscrireUser($form);

        return array('form' => $form->createView());
    }
}
