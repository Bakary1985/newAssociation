<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Excel
 *
 * @ORM\Table(name="excel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExcelRepository")
 */
class Excel
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez sélectionner un fichier excel.")
     */
    private $fichier;

    public function getFichier()
    {
        return $this->fichier;
    }

    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
        return $this;
    }
}

