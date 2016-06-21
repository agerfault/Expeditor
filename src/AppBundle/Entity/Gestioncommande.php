<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gestioncommande
 *
 * @ORM\Table(name="gestioncommande", indexes={@ORM\Index(name="IdCommande", columns={"IdCommande"}), @ORM\Index(name="IdEmploye", columns={"IdEmploye"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GestioncommandeRepository")
 */
class Gestioncommande
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="IdGestionCommande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgestioncommande;

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
     * @var \AppBundle\Entity\Employe
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Employe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdEmploye", referencedColumnName="IdEmploye")
     * })
     */
    private $idemploye;



    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Gestioncommande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get idgestioncommande
     *
     * @return integer
     */
    public function getIdgestioncommande()
    {
        return $this->idgestioncommande;
    }

    /**
     * Set idcommande
     *
     * @param \AppBundle\Entity\Commande $idcommande
     *
     * @return Gestioncommande
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
     * Set idemploye
     *
     * @param \AppBundle\Entity\Employe $idemploye
     *
     * @return Gestioncommande
     */
    public function setIdemploye(\AppBundle\Entity\Employe $idemploye = null)
    {
        $this->idemploye = $idemploye;

        return $this;
    }

    /**
     * Get idemploye
     *
     * @return \AppBundle\Entity\Employe
     */
    public function getIdemploye()
    {
        return $this->idemploye;
    }
}
