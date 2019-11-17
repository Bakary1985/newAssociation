<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Salon
 *
 * @ORM\Table(name="salon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SalonRepository")
 */
class Salon
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
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Societe", cascade={"persist", "remove"})
     */
    private $societe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Produit", mappedBy="salon")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getSociete()
    {
        return $this->societe;
    }

    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits()
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit)
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setSalon($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit)
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getSalon() === $this) {
                $produit->setSalon(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
        // TODO: Implement __toString() method.
    }
}

