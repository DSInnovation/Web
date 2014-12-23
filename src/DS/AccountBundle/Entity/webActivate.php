<?php

namespace DS\AccountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * webActivate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class webActivate
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
     * @ORM\Column(name="idWebAccount", type="integer")
     */
    private $idWebAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


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
     * Set idWebAccount
     *
     * @param integer $idWebAccount
     * @return webActivate
     */
    public function setIdWebAccount($idWebAccount)
    {
        $this->idWebAccount = $idWebAccount;

        return $this;
    }

    /**
     * Get idWebAccount
     *
     * @return integer 
     */
    public function getIdWebAccount()
    {
        return $this->idWebAccount;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return webActivate
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
