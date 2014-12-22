<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/connexion")
     * @Template()
     */
    public function connexionAction(Request $request)
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
        
        
        $form->bind($request);
        return array('form' => $form->createView());
    }
}
