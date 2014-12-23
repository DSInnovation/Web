<?php

namespace DS\CommandesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DS\CommandesBundle\Entity\WebCommande;
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
        $task = new WebCommande();
        
        $form = $this->createFormBuilder($task)
            ->add('Num_Com', 'integer')
            ->add('idLogin', 'integer')
            ->add('dateCom', 'date')
            ->add('Ref_Salon', 'integer')
            ->add('Valider', 'submit')
            ->getForm();

        return $this->render('CommandesBundle:Default:commandes.html.twig', array(
            'form2' => $form->createView(),
        ));
    }
}
