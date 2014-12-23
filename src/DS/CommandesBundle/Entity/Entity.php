<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Entity
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
     * @ORM\Column(name="Num_Com", type="integer")
     */
    private $numCom;

    /**
     * @var integer
     *
     * @ORM\Column(name="idLogin", type="integer")
     */
    private $idLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCom", type="date")
     */
    private $dateCom;

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
     * Set numCom
     *
     * @param integer $numCom
     * @return Entity
     */
    public function setNumCom($numCom)
    {
        $this->numCom = $numCom;
    
        return $this;
    }

    /**
     * Get numCom
     *
     * @return integer 
     */
    public function getNumCom()
    {
        return $this->numCom;
    }

    /**
     * Set idLogin
     *
     * @param integer $idLogin
     * @return Entity
     */
    public function setIdLogin($idLogin)
    {
        $this->idLogin = $idLogin;
    
        return $this;
    }

    /**
     * Get idLogin
     *
     * @return integer 
     */
    public function getIdLogin()
    {
        return $this->idLogin;
    }

    /**
     * Set dateCom
     *
     * @param \DateTime $dateCom
     * @return Entity
     */
    public function setDateCom($dateCom)
    {
        $this->dateCom = $dateCom;
    
        return $this;
    }

    /**
     * Get dateCom
     *
     * @return \DateTime 
     */
    public function getDateCom()
    {
        return $this->dateCom;
    }

    /**
     * Set refSalon
     *
     * @param integer $refSalon
     * @return Entity
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
