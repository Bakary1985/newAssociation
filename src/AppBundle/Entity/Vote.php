<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoteRepository")
 */
class Vote
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produit", inversedBy="vote")
     */
    private $produit;
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="salon", type="string", length=255, nullable=true)
     */
    private $salon;
    /**
     * @var string
     *
     * @ORM\Column(name="innovation", type="string", length=255, nullable=true)
     */
    private $innovation;
    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=255, nullable=true)
     */
    private $doc;
    /**
     * @var string
     *
     * @ORM\Column(name="datevote", type="datetime", length=255, nullable=true)
     */
    private $date_vote;

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
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Vote
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @return string
     */
    public function getSalon()
    {
        return $this->salon;
    }

    /**
     * @return string
     */
    public function getDoc()
    {
        return $this->doc;
    }

    /**
     * @param string $doc
     */
    public function setDoc($doc)
    {
        $this->doc = $doc;
    }

    /**
     * @param string $salon
     */
    public function setSalon($salon)
    {
        $this->salon = $salon;
    }

    /**
     * @return string
     */
    public function getInnovation()
    {
        return $this->innovation;
    }

    /**
     * @param string $innovation
     */
    public function setInnovation($innovation)
    {
        $this->innovation = $innovation;
    }

    /**
     * @return string
     */
    public function getDateVote()
    {
        return $this->date_vote;
    }

    /**
     * @param string $date_vote
     */
    public function setDateVote($date_vote)
    {
        $this->date_vote = $date_vote;
    }

    public function __toString()
    {
        return $this->salon;
        // TODO: Implement __toString() method.
    }


}

