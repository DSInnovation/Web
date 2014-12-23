<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
                    'label' => 'Mot de passe (vérification) : '
                ))
                ->add('email', 'email' , array (
                    'label' => 'Adresse mail(enregistré dans nos salons) : '
                ))
                ->add('submit', 'submit', array (
                    'label' => 'S\'inscrire'
                ))
                ->getForm();
        
        return $form;
    }
    
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
     * @Route(path="/inscription", name="inscription")
     * @Template()
     */
    public function inscriptionAction(Request $request)
    {
        $session = $request->getSession();
        
        $form = $this->createFormInscription();
        
        if(!$request->isMethod('post')) {
            return array('form' => $form->createView());
        }
        
        $form->bind($request);
        
        if(!$form->isValid()) {
            return array('form' => $form->createView());
        }
        
        if($form->get('password')->getData() == $form->get('passwordverif')->getData()) {
            if($this->checkLoginFree($form->get('login')->getData())) {
                
            }
        }
        
        if($session->get('id')) {
            return $this->redirect($this->generateUrl("index"));
        }
        return array('form' => $form->createView());
    }
}
