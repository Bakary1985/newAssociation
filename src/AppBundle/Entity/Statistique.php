<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatistiqueRepository")
 */
class Statistique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idproduit", type="string", length=255, nullable=true)
     */
    private $idproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="idnomenclature", type="string", length=255, nullable=true)
     */
    private $idnomenclature;

    /**
     * @var string
     *
     * @ORM\Column(name="zone", type="string", length=255, nullable=true)
     */
    private $zone;

    /**
     * @var string
     *
     * @ORM\Column(name="dateclick", type="datetime", length=255, nullable=true)
     */
    private $dateclick;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    /**
     * @param string $idproduit
     */
    public function setIdproduit($idproduit)
    {
        $this->idproduit = $idproduit;
    }

    /**
     * @return string
     */
    public function getIdnomenclature()
    {
        return $this->idnomenclature;
    }

    /**
     * @param string $idnomenclature
     */
    public function setIdnomenclature($idnomenclature)
    {
        $this->idnomenclature = $idnomenclature;
    }

    /**
     * Set zone
     *
     * @param string $zone
     *
     * @return Statistique
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return string
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @return string
     */
    public function getDateclick()
    {
        return $this->dateclick;
    }

    /**
     * @param string $dateclick
     */
    public function setDateclick($dateclick)
    {
        $this->dateclick = $dateclick;
    }

}

