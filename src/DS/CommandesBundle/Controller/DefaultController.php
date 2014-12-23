<?php

namespace DS\CommandesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DS\CommandesBundle\Entity\WebLogin;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route(path="/commandes/", name = "commandes_form")
     * @Template()
     */
    public function commandesAction(Request $req)
    {
         // crée une tâche et lui donne quelques données par défaut pour cet exemple
        $task = new WebLogin();
        
        $form = $this->createFormBuilder($task)
            ->add('username', 'text')
            ->add('save', 'submit')
            ->getForm();

        return $this->render('CommandesBundle:Default:commandes.html.twig', array(
            'form2' => $form->createView(),
        ));
    }
}
