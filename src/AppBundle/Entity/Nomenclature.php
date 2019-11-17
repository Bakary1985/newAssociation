<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nomenclature
 *
 * @ORM\Table(name="nomenclature")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NomenclatureRepository")
 */
class Nomenclature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_parcours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaires;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Produit", mappedBy="nomenclature")
     */
    private $produits;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_modif;


    public function __toString()
    {
        return $this->nom;
        // TODO: Implement __toString() method.
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Nomenclature
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
     * Set nomFr
     *
     * @param string $nomFr
     *
     * @return Nomenclature
     */
    public function setNomFr($nomFr)
    {
        $this->nom_fr = $nomFr;

        return $this;
    }

    /**
     * Get nomFr
     *
     * @return string
     */
    public function getNomFr()
    {
        return $this->nom_fr;
    }

    /**
     * Set nomEn
     *
     * @param string $nomEn
     *
     * @return Nomenclature
     */
    public function setNomEn($nomEn)
    {
        $this->nom_en = $nomEn;

        return $this;
    }

    /**
     * Get nomEn
     *
     * @return string
     */
    public function getNomEn()
    {
        return $this->nom_en;
    }

    /**
     * Set lienParcours
     *
     * @param string $lienParcours
     *
     * @return Nomenclature
     */
    public function setLienParcours($lienParcours)
    {
        $this->lien_parcours = $lienParcours;

        return $this;
    }

    /**
     * Get lienParcours
     *
     * @return string
     */
    public function getLienParcours()
    {
        return $this->lien_parcours;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Nomenclature
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set horaires
     *
     * @param string $horaires
     *
     * @return Nomenclature
     */
    public function setHoraires($horaires)
    {
        $this->horaires = $horaires;

        return $this;
    }

    /**
     * Get horaires
     *
     * @return string
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Nomenclature
     */
    public function setDateModif($dateModif)
    {
        $this->date_modif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->date_modif;
    }

    /**
     * Add produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Nomenclature
     */
    public function addProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produits[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\Produit $produit
     */
    public function removeProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produits->removeElement($produit);
    }

    /**
     * Get produits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduits()
    {
        return $this->produits;
    }

}
