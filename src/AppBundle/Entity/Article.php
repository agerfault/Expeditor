<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=120, nullable=false)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="Poids", type="integer", nullable=false)
     */
    private $poids;

    /**
     * @var integer
     *
     * @ORM\Column(name="IdArticle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idarticle;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Article
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
     * Set poids
     *
     * @param integer $poids
     *
     * @return Article
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return integer
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Get idarticle
     *
     * @return integer
     */
    public function getIdarticle()
    {
        return $this->idarticle;
    }
}
