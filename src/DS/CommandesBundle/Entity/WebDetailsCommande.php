<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebDetailsCommande
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WebDetailsCommande
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
     * @ORM\Column(name="id_DC", type="integer")
     */
    private $idDC;

    /**
     * @var integer
     *
     * @ORM\Column(name="Num_Com", type="integer")
     */
    private $numCom;

    /**
     * @var integer
     *
     * @ORM\Column(name="idProd", type="integer")
     */
    private $idProd;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


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
     * Set idDC
     *
     * @param integer $idDC
     * @return Web_Details_Commande
     */
    public function setIdDC($idDC)
    {
        $this->idDC = $idDC;
    
        return $this;
    }

    /**
     * Get idDC
     *
     * @return integer 
     */
    public function getIdDC()
    {
        return $this->idDC;
    }

    /**
     * Set numCom
     *
     * @param integer $numCom
     * @return Web_Details_Commande
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
     * Set idProd
     *
     * @param integer $idProd
     * @return Web_Details_Commande
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
     * Set quantite
     *
     * @param integer $quantite
     * @return Web_Details_Commande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
}
