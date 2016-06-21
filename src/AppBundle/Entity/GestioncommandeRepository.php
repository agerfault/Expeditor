<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Employe;

/**
 * Gestioncommande
 *
 * @ORM\Table(name="gestioncommande", indexes={@ORM\Index(name="IdCommande", columns={"IdCommande"}), @ORM\Index(name="IdEmploye", columns={"IdEmploye"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GestionCommandeRepository")
 */
class Gestioncommande extends EntityRepository
{
    /*
     * Liste des commandes réalisé par l'employé passé en param
     */
    public function LstCommandeEmploye(Employe $Emp) {
        
        $query = $this->getEntityManager()
                        ->createQuery(
                            'SELECT gc, e '
                                . 'FROM AppBundle:Gestioncommande gc '
                                . 'JOIN gc.idemploye e '
                                . 'WHERE e.idemploye = :emplo');
        $query->setParameter('emplo', $Emp->getIdemploye());
        return $query->getArrayResult();
    }
    
    
}
