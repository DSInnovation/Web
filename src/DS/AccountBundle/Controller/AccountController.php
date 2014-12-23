<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

class AccountController extends Controller
{
    /**
     * 
     * 
     */
    public function jointureAction()
    {
        $session = new Session();
    
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('
            SELECT A.login, A.password, C.prenom, C.sexe, C.email, C.DateNaissance, F.nom, F.adresse, F.points
            FROM DSAccountBundle:webAccount A 
            INNER JOIN DSAccountBundle:appClient C ON A.idClient = C.id
            INNER JOIN DSAccountBundle:appFamille F ON C.IdFamille = F.id;
        ');

   $query->setParameter('id', $session->get('id'));

        return $query->getResult();
    }

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
        } else {
            return $this->redirect ($this->generateUrl ("moncompte"));
        }
       
        
        $infos = $this->jointureAction();
   //     var_dump($infos);
        return array('infoaccount' => $infos);
    }
}
