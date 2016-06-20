<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignearticle
 *
 * @ORM\Table(name="lignearticle", indexes={@ORM\Index(name="IdCommande", columns={"IdCommande"}), @ORM\Index(name="IdArticle", columns={"IdArticle"})})
 * @ORM\Entity
 */
class Lignearticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="IdLigne", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idligne;

    /**
     * @var \AppBundle\Entity\Commande
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdCommande", referencedColumnName="IdCommande")
     * })
     */
    private $idcommande;

    /**
     * @var \AppBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdArticle", referencedColumnName="IdArticle")
     * })
     */
    private $idarticle;



    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Lignearticle
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

    /**
     * Get idligne
     *
     * @return integer
     */
    public function getIdligne()
    {
        return $this->idligne;
    }

    /**
     * Set idcommande
     *
     * @param \AppBundle\Entity\Commande $idcommande
     *
     * @return Lignearticle
     */
    public function setIdcommande(\AppBundle\Entity\Commande $idcommande = null)
    {
        $this->idcommande = $idcommande;

        return $this;
    }

    /**
     * Get idcommande
     *
     * @return \AppBundle\Entity\Commande
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }

    /**
     * Set idarticle
     *
     * @param \AppBundle\Entity\Article $idarticle
     *
     * @return Lignearticle
     */
    public function setIdarticle(\AppBundle\Entity\Article $idarticle = null)
    {
        $this->idarticle = $idarticle;

        return $this;
    }

    /**
     * Get idarticle
     *
     * @return \AppBundle\Entity\Article
     */
    public function getIdarticle()
    {
        return $this->idarticle;
    }
}
