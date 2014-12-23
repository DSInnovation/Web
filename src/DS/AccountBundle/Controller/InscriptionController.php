<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

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
    
    
    public function inscrireUser($form)
    {
        $em = $this->getDoctrine()->getManager();
        $accountRepo = $em->getRepository('DSAccountBundle:webAccount');
        $activeRepo = $em->getRepository('DSAccountBundle:webActivate');
        
        $data = $form->getData();
        
        if($data['password'] != $data['passwordverif']) {
            $form->addError(new FormError('Les mots de passes différent !'));
        }
        
        $userExist = $accountRepo->findBy(array('login' => $data['login']));
        if($userExist) {
            $form->addError(new FormError('Le login est déjà prit !'));
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
