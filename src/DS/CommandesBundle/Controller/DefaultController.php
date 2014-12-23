<?php

namespace DS\CommandesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DS\CommandesBundle\Entity\Entity;
use DS\CommandesBundle\Form\EntityType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route(path="/commandes/", name = "commandes_form")
     * @Template()
     */
    public function commandesAction(Request $req)
    {
        $form = $this->createForm(new EntityType());
        
        if($form->handleRequest($req)->isValid())
        {
            $cde = $form->getData();
            $this->getDoctrine()->getManager()->persist($cde);
            $this->getDoctrine()->getManager()->flush();
            $this->getForm();
        }
        
        else
        {
            return array("<body><h1>PROBLEM</h1></body>");
        }
       
        return array('form' => $form->createView());
    }
}
