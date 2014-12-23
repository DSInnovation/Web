<?php

namespace DS\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route(path="/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        // On récupère l'EntityManager
        $var = $this->getDoctrine()->getManager();
        $image = $var->getRepository('DSBaseBundle:webHomePicture');
        
        $pictures = $image->findAll();
        
        return array();
    }
}
