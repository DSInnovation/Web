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
            return $this->redirect($this->generateUrl('inscription'));
        }
        
        return $existClient->getId();
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
     * Generate random URL with 255 characters
     * 
     * @return string
     */
    private function randomUrl()
    {
        $assoc = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $nombre_de_caracteres_max = 255;
        $caracteres_aleatoires = "";

        for ($i = 1; $i <= $nombre_de_caracteres_max; $i++)
        {
           //On génère un caractère alphanumérique aléatoire
           $caracteres_aleatoires .= $assoc[rand(0, 61)];
        }
        
        return $caracteres_aleatoires;
    }
    
    private function sendConfirmationMail($login, $url, $mail)
    {
        $message = \Swift_Message::newInstance()
                ->setSubject('Mail de validation')
                ->setFrom('dsinnov@gmail.com')
                ->setTo($mail)
                ->setContentType('text/html')
                ->setBody('Bonjour '. $login . ',<br />'
                        . 'Pour valider votre compte, merci de cliquez sur le lien suivant : <br />'
                        . '<a href="http://127.0.0.1/account/validate/' . $url . '">Cliquez ici</a>');
        
        $this->get('mailer')->send($message);
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
            $validate->setUrl($this->randomUrl());
            $em->persist($validate);
            $em->flush();
            
            $this->sendConfirmationMail($form->get('login')->getData(),
                    $validate->getUrl(), 
                    $form->get('email')->getData()
            );
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
