<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use DS\AccountBundle\Entity\webAccount;

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
    private function checkLoginFree($login)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DSAccountBundle:webAccount');
        
        $check = $repository->findBy(array (
            'login' => $login
        ));
        
        return $check == null;
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
        $accountRepo = $em->getRepository('DSAccountBundle:webAccount');
        $clientRepo = $em->getRepository('DSAccountBundle:appClient');
        $activeRepo = $em->getRepository('DSAccountBundle:webActivate');
        
        $data = $form->getData();
        
        if($data['password'] != $data['passwordverif']) {
            $form->addError(new FormError('Les mots de passes différent !'));
        }
        
        $existUserLogin = $accountRepo->findBy(array('login' => $data['login']));
        if($existUserLogin) {
            $form->addError(new FormError('Le login est déjà prit !'));
        }
        
        /*$existUserMail = $accountRepo->findBy(array('email' => $data['email']));
        if($existUserMail) {
            $form->addError(new FormError('L\'adresse mail est déjà prit !'));
        }*/
        
        $existClient = $clientRepo->findOneBy(array('email' => $data['email']));
        if(!$existClient) {
            $form->addError(new FormError('L\'adresse mail n\'existe pas'));
        }
        
        if(!$form->getErrorsAsString()) {
            $user = new webAccount();
            $user->setActivate(0);
            $user->setIdClient($existClient->getId());
            $user->setLogin($data['login']);
            $user->setPassword($data['password']);
            $em->persist($user);
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
