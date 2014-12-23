<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebLogin
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WebLogin
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
     * @ORM\Column(name="idLogin", type="integer")
     */
    private $idLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCli", type="integer")
     */
    private $idCli;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="MdP", type="string", length=255)
     */
    private $mdP;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActivite", type="boolean")
     */
    private $isActivite;

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
     * Set idLogin
     *
     * @param integer $idLogin
     * @return Web_Login
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
     * Set idCli
     *
     * @param integer $idCli
     * @return Web_Login
     */
    public function setIdCli($idCli)
    {
        $this->idCli = $idCli;
    
        return $this;
    }

    /**
     * Get idCli
     *
     * @return integer 
     */
    public function getIdCli()
    {
        return $this->idCli;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Web_Login
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set mdP
     *
     * @param string $mdP
     * @return Web_Login
     */
    public function setMdP($mdP)
    {
        $this->mdP = $mdP;
    
        return $this;
    }

    /**
     * Get mdP
     *
     * @return string 
     */
    public function getMdP()
    {
        return $this->mdP;
    }

    /**
     * Set isActivite
     *
     * @param boolean $isActivite
     * @return Web_Login
     */
    public function setIsActivite($isActivite)
    {
        $this->isActivite = $isActivite;
    
        return $this;
    }

    /**
     * Get isActivite
     *
     * @return boolean 
     */
    public function getIsActivite()
    {
        return $this->isActivite;
    }

    /**
     * Set refSalon
     *
     * @param integer $refSalon
     * @return Web_Login
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
