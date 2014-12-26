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
     * @Route(path = "/menu", name="menu")
     * @Template()
     */
    public function menuAction()
    {
        $session = new Session();
        $session->start();
        
        if(null != $session->get('id')){
            $menu[0]['nom'] = 'ACCUEIL';
            $menu[0]['lien'] = './';
            $menu[1]['nom'] = 'PRODUITS';
            $menu[1]['lien'] = './';
            $menu[2]['nom'] = 'MON COMPTE';
            $menu[2]['lien'] = './compte';
            $menu[3]['nom'] = 'DECONNEXION';
            $menu[3]['lien'] = './deconnexion';
        } else {
            $menu[0]['nom'] = 'ACCUEIL';
            $menu[0]['lien'] = './';
            $menu[1]['nom'] = 'PRODUITS';
            $menu[1]['lien'] = './';
            $menu[2]['nom'] = 'S\'INSCRIRE';
            $menu[2]['lien'] = './inscription';
            $menu[3]['nom'] = 'CONNEXION';
            $menu[3]['lien'] = './connexion';
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
}