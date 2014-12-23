<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

class AccountController extends Controller
{
    /**
     * @Route(path="/compte", name="moncompte")
     * @Template()
     */
    public function monCompteAction()
    {
        $session = new Session();
        $session->Start();
        
        if(!$session->get('id')) {
            return $this->redirect ($this->generateUrl ("connexion"));
        }
        
        $var = $this->getDoctrine()->getManager();
        $info = $var->getRepository('DSAccountBundle:webAccount');
        
        $infos = $info->findOneBy(array('id' => $session->get('id')));

        return array('infoaccount' => $infos);
    }
}
