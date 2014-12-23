<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebActiveUrl
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WebActiveUrl
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
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;


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
     * @return Web_ActiveUrl
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
     * Set lien
     *
     * @param string $lien
     * @return Web_ActiveUrl
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    
        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }
}
