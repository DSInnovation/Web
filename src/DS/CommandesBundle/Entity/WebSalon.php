<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebSalon
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WebSalon
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
     * @ORM\Column(name="Ref_Salon", type="integer")
     */
    private $refSalon;

    /**
     * @var integer
     *
     * @ORM\Column(name="idRegion", type="integer")
     */
    private $idRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;


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
     * Set refSalon
     *
     * @param integer $refSalon
     * @return Web_Salon
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

    /**
     * Set idRegion
     *
     * @param integer $idRegion
     * @return Web_Salon
     */
    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;
    
        return $this;
    }

    /**
     * Get idRegion
     *
     * @return integer 
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Web_Salon
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Web_Salon
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }
}
