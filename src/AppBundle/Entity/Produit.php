<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Societe", inversedBy="produits")
     */
    private $id_societe;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Salon", inversedBy="produits")
     */
    private $salon;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Nomenclature", inversedBy="produits")
     */
    private $nomenclature;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vote", mappedBy="produit")
     */
    private $vote;
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
    private $univers_technologique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_fr;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $service_rendu_fr;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $service_rendu_en;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nominer;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_produit_fr;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_produit_en;


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
     * Set nomFr
     *
     * @param string $nomFr
     *
     * @return Produit
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
     * @return Produit
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
     * @return mixed
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param mixed $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * Set universTechnologique
     *
     * @param string $universTechnologique
     *
     * @return Produit
     */
    public function setUniversTechnologique($universTechnologique)
    {
        $this->univers_technologique = $universTechnologique;

        return $this;
    }

    /**
     * Get universTechnologique
     *
     * @return string
     */
    public function getUniversTechnologique()
    {
        return $this->univers_technologique;
    }

    /**
     * Set marche
     *
     * @param string $marche
     *
     * @return Produit
     */
    public function setMarche($marche)
    {
        $this->marche = $marche;

        return $this;
    }

    /**
     * Get marche
     *
     * @return string
     */
    public function getMarche()
    {
        return $this->marche;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     *
     * @return Produit
     */
    public function setDescriptionFr($descriptionFr)
    {
        $this->description_fr = $descriptionFr;

        return $this;
    }

    /**
     * Get descriptionFr
     *
     * @return string
     */
    public function getDescriptionFr()
    {
        return $this->description_fr;
    }

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     *
     * @return Produit
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->description_en = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn
     *
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->description_en;
    }

    /**
     * Set serviceRenduFr
     *
     * @param string $serviceRenduFr
     *
     * @return Produit
     */
    public function setServiceRenduFr($serviceRenduFr)
    {
        $this->service_rendu_fr = $serviceRenduFr;

        return $this;
    }

    /**
     * Get serviceRenduFr
     *
     * @return string
     */
    public function getServiceRenduFr()
    {
        return $this->service_rendu_fr;
    }

    /**
     * Set serviceRenduEn
     *
     * @param string $serviceRenduEn
     *
     * @return Produit
     */
    public function setServiceRenduEn($serviceRenduEn)
    {
        $this->service_rendu_en = $serviceRenduEn;

        return $this;
    }

    /**
     * Get serviceRenduEn
     *
     * @return string
     */
    public function getServiceRenduEn()
    {
        return $this->service_rendu_en;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Produit
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set qcode
     *
     * @param string $qcode
     *
     * @return Produit
     */
    public function setQcode($qcode)
    {
        $this->qcode = $qcode;

        return $this;
    }

    /**
     * Get qcode
     *
     * @return string
     */
    public function getQcode()
    {
        return $this->qcode;
    }

    /**
     * Set pdf
     *
     * @param string $pdf
     *
     * @return Produit
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;

        return $this;
    }

    /**
     * Get pdf
     *
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * Set avant
     *
     * @param string $avant
     *
     * @return Produit
     */
    public function setAvant($avant)
    {
        $this->avant = $avant;

        return $this;
    }

    /**
     * Get avant
     *
     * @return string
     */
    public function getAvant()
    {
        return $this->avant;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Produit
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set nominer
     *
     * @param string $nominer
     *
     * @return Produit
     */
    public function setNominer($nominer)
    {
        $this->nominer = $nominer;

        return $this;
    }

    /**
     * Get nominer
     *
     * @return string
     */
    public function getNominer()
    {
        return $this->nominer;
    }

    /**
     * Set lienProduitFr
     *
     * @param string $lienProduitFr
     *
     * @return Produit
     */
    public function setLienProduitFr($lienProduitFr)
    {
        $this->lien_produit_fr = $lienProduitFr;

        return $this;
    }

    /**
     * Get lienProduitFr
     *
     * @return string
     */
    public function getLienProduitFr()
    {
        return $this->lien_produit_fr;
    }

    /**
     * Set lienProduitEn
     *
     * @param string $lienProduitEn
     *
     * @return Produit
     */
    public function setLienProduitEn($lienProduitEn)
    {
        $this->lien_produit_en = $lienProduitEn;

        return $this;
    }

    /**
     * Get lienProduitEn
     *
     * @return string
     */
    public function getLienProduitEn()
    {
        return $this->lien_produit_en;
    }

    /**
     * Set idSociete
     *
     * @param \AppBundle\Entity\Societe $idSociete
     *
     * @return Produit
     */
    public function setIdSociete(\AppBundle\Entity\Societe $idSociete = null)
    {
        $this->id_societe = $idSociete;

        return $this;
    }

    /**
     * Get idSociete
     *
     * @return \AppBundle\Entity\Societe
     */
    public function getIdSociete()
    {
        return $this->id_societe;
    }

    /**
     * Set salon
     *
     * @param \AppBundle\Entity\Salon $salon
     *
     * @return Produit
     */
    public function setSalon(\AppBundle\Entity\Salon $salon = null)
    {
        $this->salon = $salon;

        return $this;
    }

    /**
     * Get salon
     *
     * @return \AppBundle\Entity\Salon
     */
    public function getSalon()
    {
        return $this->salon;
    }

    /**
     * Set nomenclature
     *
     * @param \AppBundle\Entity\Nomenclature $nomenclature
     *
     * @return Produit
     */
    public function setNomenclature(\AppBundle\Entity\Nomenclature $nomenclature = null)
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    /**
     * Get nomenclature
     *
     * @return \AppBundle\Entity\Nomenclature
     */
    public function getNomenclature()
    {
        return $this->nomenclature;
    }
    public function __toString()
    {
        return $this->nom_fr;
        // TODO: Implement __toString() method.
    }
}
