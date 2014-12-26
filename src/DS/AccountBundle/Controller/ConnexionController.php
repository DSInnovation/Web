<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

class ConnexionController extends Controller
{
    /**
     * Create connexion form
     * @return form
     */
    private function createFormConnexion()
    {
        $form = $this->createFormBuilder()
                ->add('login', 'text', array(
                    'label' => 'Nom de compte : '
                ))
                ->add('password', 'password', array (
                    'label' => 'Mot de passe : '
                ))
                ->add('submit', 'submit', array (
                    'label' => 'Se connecter'
                ))
                ->getForm();
        
        return $form;
    }
    
    /**
     * @Route(path = "/connexion", name="connexion")
     * @Template()
     */
    public function connexionAction(Request $request)
    {
        $form = $this->createFormConnexion();
        // Check if the request is a POST method
        if(!$request->isMethod('post')) {
            return array('form' => $form->createView());
        }
        
        $form->bind($request);
        // Check if the form is valid
        if(!$form->isValid()) {
            return array('form' => $form->createView());
        }
        
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DSAccountBundle:webAccount');

        $user = $repository->findOneBy(
                    array(
                        'login' => $form->get('login')->getData(),
                        'password' => $form->get('password')->getData()
                    ));

        if($user) {
            if(1 == $user->getActivate()) {
                $session = $request->getSession();
                $session->set('id', $user->getId());
                return $this->redirect($this->generateUrl('compte'));
            } else {
                $form->addError(new FormError('Le compte n\'est pas actif !'));
            }
        }
        
        return array('form' => $form->createView());
    }
    
    /**
     * Check in webAccount table, if activate raw
     * is set to "0" then add a FormError
     * 
     * @param
     */
    public function checkUserActivatedAccount($user)
    {
        
    }
    
    /**
     * Check in webAccount table, if login is incorrect
     * then add a FormError
     * 
     * @param
     */
    public function checkUserLogin()
    {
        
    }
    
    /**
     * Check in webAccount table, if password is incorrect
     * then add a FormError
     * 
     * @param
     */
    public function checkUserPassword()
    {
        
    }
}
