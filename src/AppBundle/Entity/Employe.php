<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employe
 *
 * @ORM\Table(name="employe")
 * @ORM\Entity
 */
class Employe
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=35, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="MotDePasse", type="string", length=35, nullable=false)
     */
    private $motdepasse;

    /**
     * @var integer
     *
     * @ORM\Column(name="Statut", type="integer", nullable=false)
     */
    private $statut;

    /**
     * @var integer
     *
     * @ORM\Column(name="IdEmploye", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idemploye;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Employe
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
     * Set motdepasse
     *
     * @param string $motdepasse
     *
     * @return Employe
     */
    public function setMotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    /**
     * Get motdepasse
     *
     * @return string
     */
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * Set statut
     *
     * @param integer $statut
     *
     * @return Employe
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return integer
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Get idemploye
     *
     * @return integer
     */
    public function getIdemploye()
    {
        return $this->idemploye;
    }
}
