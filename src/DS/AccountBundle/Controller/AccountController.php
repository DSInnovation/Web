<?php

namespace DS\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * Create query for Informations User Profil
     * @return query
     */
    private function LoadUserInformation()
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
       
        $infos = $this->LoadUserInformation();
        
        return array('infoaccount' => $infos);
    }
    
    
    /**
     * Create a form to edit user's password
     * 
     * @return form form
     */
    private function createEditPasswordForm() {
        $form = $this->createFormBuilder()
                ->add('password', 'password', array (
                    'label' => 'Mot de passe : '
                ))
                ->add('passwordverif', 'password', array (
                    'label' => 'Répéter Mot de passe : '
                ))
                ->add('Cancel', 'button')
                ->add('Modifier', 'submit')
                ->getForm();
        
        return $form;
    }
    
    /**
     * @Route("/compte/edit/password")
     * @Template()
     * 
     * @param Request $request
     */
    public function editPasswordAction(Request $request)
    {
        $form = $this->createEditPasswordForm();
        return array('form' => $form->createView());
        //return $this->redirect($this->generateUrl("compte"));
    }
    
    /**
     * Create a form to edit user's tel number
     * 
     * @return form form
     */
    private function createEditPhoneForm() {
        $form = $this->createFormBuilder()
                ->add('tel', 'text', array(
                    'label' => 'Téléphone : '
                ))
                ->add('Annuler', 'button')
                ->add('Editer', 'submit')
                ->getForm();
        
        return $form;
    }
    
    /**
     * @Route("/compte/edit/phone")
     * @Template()
     * 
     * @param Request $request
     */
    public function editPhoneAction(Request $request)
    {
        $form = $this->createEditPhoneForm();
        return array('form' => $form->createView());
    }
}
