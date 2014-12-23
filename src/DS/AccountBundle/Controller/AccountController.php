<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

class AccountController extends Controller
{
    /**
     * Create query for Informations User Profil
     * @return query
     */
    public function jointureAction()
    {
        $session = new Session();
    
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('
            SELECT A.login, A.password, C.prenom, C.sexe, C.email, C.dateNaissance, C.tel, F.nom, F.adresse, F.points
            FROM DSAccountBundle:webAccount A, DSAccountBundle:appClient C, DSAccountBundle:appFamille F
            WHERE A.id = :id
            AND A.idClient = C.id
            AND C.idFamille = F.id
        ')->setParameter('id', $session->get('id'));

        return $query->getSingleResult();
    }

        /**
     * @Route(path="/compte", name="compte")
     * @Template()
     */
    public function monCompteAction()
    {
        $session = new Session();
        $session->Start();
        
        if(!$session->get('id')) {
            return $this->redirect ($this->generateUrl ("connexion"));
        } 
       
        
        $infos = $this->jointureAction();
        
        return array('infoaccount' => $infos);
    }
}
