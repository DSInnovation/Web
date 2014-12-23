<?php

namespace DS\CommandesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebProduit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WebProduit
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
     * @ORM\Column(name="idProd", type="integer")
     */
    private $idProd;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantiteStock", type="integer")
     */
    private $quantiteStock;

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
     * Set idProd
     *
     * @param integer $idProd
     * @return Web_Produit
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
     * Set nom
     *
     * @param string $nom
     * @return Web_Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Web_Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Web_Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    
        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set quantiteStock
     *
     * @param integer $quantiteStock
     * @return Web_Produit
     */
    public function setQuantiteStock($quantiteStock)
    {
        $this->quantiteStock = $quantiteStock;
    
        return $this;
    }

    /**
     * Get quantiteStock
     *
     * @return integer 
     */
    public function getQuantiteStock()
    {
        return $this->quantiteStock;
    }

    /**
     * Set refSalon
     *
     * @param integer $refSalon
     * @return Web_Produit
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
