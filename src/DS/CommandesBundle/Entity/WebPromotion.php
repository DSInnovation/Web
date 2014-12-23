<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebPromotion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WebPromotion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="code_Promo", type="integer")
     */
    private $codePromo;

    /**
     * @var float
     *
     * @ORM\Column(name="taux", type="float")
     */
    private $taux;

    /**
     * @var integer
     *
     * @ORM\Column(name="idProd", type="integer")
     */
    private $idProd;

    /**
     * @var integer
     *
     * @ORM\Column(name="Ref_Salon", type="integer")
     */
    private $refSalon;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codePromo
     *
     * @param integer $codePromo
     * @return Web_Promotion
     */
    public function setCodePromo($codePromo)
    {
        $this->codePromo = $codePromo;
    
        return $this;
    }

    /**
     * Get codePromo
     *
     * @return integer 
     */
    public function getCodePromo()
    {
        return $this->codePromo;
    }

    /**
     * Set taux
     *
     * @param float $taux
     * @return Web_Promotion
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;
    
        return $this;
    }

    /**
     * Get taux
     *
     * @return float 
     */
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * Set idProd
     *
     * @param integer $idProd
     * @return Web_Promotion
     */
    public function setIdProd($idProd)
    {
        $this->idProd = $idProd;
    
        return $this;
    }

    /**
     * Get idProd
     *
     * @return integer 
     */
    public function getIdProd()
    {
        return $this->idProd;
    }

    /**
     * Set refSalon
     *
     * @param integer $refSalon
     * @return Web_Promotion
     */
    public function setRefSalon($refSalon)
    {
        $this->refSalon = $refSalon;
    
        return $this;
    }

    /**
     * Get refSalon
     *
     * @return integer 
     */
    public function getRefSalon()
    {
        return $this->refSalon;
    }
}
