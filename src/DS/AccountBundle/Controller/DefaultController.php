<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * Create a form
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
                return $this->redirect($this->generateUrl('index'));
            }
        }
        return array('form' => $form->createView());
    }
    
    /**
     * @Route(path = "/menu", name="menu")
     * @Template()
     */
    public function menuAction()
    {
        $session = new Session();
        $session->start();
        
        if(null != $session->get('id')){
            $menu[0]['nom'] = 'ACCUEIL';
            $menu[0]['lien'] = '/';
            $menu[1]['nom'] = 'PRODUITS';
            $menu[1]['lien'] = '/';
            $menu[2]['nom'] = 'MON COMPTE';
            $menu[2]['lien'] = '/compte';
            $menu[3]['nom'] = 'DECONNEXION';
            $menu[3]['lien'] = '/deconnexion';
        } else {
            $menu[0]['nom'] = 'ACCUEIL';
            $menu[0]['lien'] = '/';
            $menu[1]['nom'] = 'PRODUITS';
            $menu[1]['lien'] = '/';
            $menu[2]['nom'] = 'S\'INSCRIRE';
            $menu[2]['lien'] = '/inscription';
            $menu[3]['nom'] = 'CONNEXION';
            $menu[3]['lien'] = '/connexion';
        }
        
        return array('menus' => $menu);
    }
    
    /**
     * @Route(path="/deconnexion", name="deconnexion")
     * @Template()
     */
    public function deconnexionAction()
    {
        $session = new Session();
        $session->Start();
        
        if($session->get('id')) {
            $session->remove('id');
        }
        
        return $this->redirect($this->generateUrl('index'));
    }
    
    /**
     * @Route(path="/inscription", name="inscription")
     * @Template()
     */
    public function inscriptionAction()
    {
        $session = new Session();
        $session->Start();
        
        if($session->get('id')) {
            return $this->redirect($this->generateUrl("index"));
        }
        return array();
    }
}
