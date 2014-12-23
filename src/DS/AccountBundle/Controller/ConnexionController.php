<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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

        if(!$request->isMethod('post')) {
            return array('form' => $form->createView());
        }
        
        $form->bind($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('DSAccountBundle:webAccount');

            $user = $repository->findBy(
                        array(
                            'login' => $form->get('login')->getData(),
                            'password' => $form->get('password')->getData()
                        ));

            if(1 == count($user)) {
                $session = $request->getSession();
                $session->set('id', $user[0]->getId());
                return $this->redirect($this->generateUrl('compte'));
            }
        }
        return array('form' => $form->createView());
    }
}
