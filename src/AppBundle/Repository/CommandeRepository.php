<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of CommandeRepository
 *
 * @author Administrateur
 */
class CommandeRepository extends EntityRepository {

    protected $_em;
    /*
     * Liste des commandes r�alis� par l'employ� pass� en param
     */
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->_em = $em;
    }
    
    public function findAllCommandes() {
        
        $query = $this->getEntityManager()
                        ->createQuery(
                            'SELECT e.nom as nomemp, c.idcommande, c.date, c.statut, cli.nom as nomcli '
                                . 'FROM AppBundle:Commande c '
                                . 'LEFT JOIN AppBundle:Gestioncommande gc WITH gc.idcommande = c.idcommande '
                                . 'LEFT JOIN AppBundle:Employe e WITH e.idemploye = gc.idemploye '
                                . 'LEFT JOIN AppBundle:Client cli WITH c.idclient = cli.idclient ');
        return $query->getArrayResult();
    }

    public function findCommandesByIdEmploye($idemploye) {
        
        $query = $this->getEntityManager()
                        ->createQuery(
                            'SELECT e.nom as nomemp, c.idcommande, c.date, c.statut, cli.nom as nomcli '
                                . 'FROM AppBundle:Commande c '
                                . 'LEFT JOIN AppBundle:Gestioncommande gc WITH gc.idcommande = c.idcommande '
                                . 'LEFT JOIN AppBundle:Employe e WITH e.idemploye = gc.idemploye '
                                . 'LEFT JOIN AppBundle:Client cli WITH c.idclient = cli.idclient '
                                . 'WHERE e.idemploye = :idemploye ');
        $query->setParameter('idemploye', $idemploye);
        return $query->getArrayResult();
    }

    public function findCommandesByStatut($statut) {
        
        $query = $this->getEntityManager()
                        ->createQuery(
                            'SELECT e.nom as nomemp, c.idcommande, c.date, c.statut, cli.nom as nomcli '
                                . 'FROM AppBundle:Commande c '
                                . 'LEFT JOIN AppBundle:Gestioncommande gc WITH gc.idcommande = c.idcommande '
                                . 'LEFT JOIN AppBundle:Employe e WITH e.idemploye = gc.idemploye '
                                . 'LEFT JOIN AppBundle:Client cli WITH c.idclient = cli.idclient '
                                . 'WHERE c.statut = :statut ');
        $query->setParameter('statut', $statut);
        return $query->getArrayResult();
    }

    public function findCommandesByStatutAndIdEmploye($statut, $idemploye) {
        
        $query = $this->getEntityManager()
                        ->createQuery(
                            'SELECT e.nom as nomemp, c.idcommande, c.date, c.statut, cli.nom as nomcli '
                                . 'FROM AppBundle:Commande c '
                                . 'LEFT JOIN AppBundle:Gestioncommande gc WITH gc.idcommande = c.idcommande '
                                . 'LEFT JOIN AppBundle:Employe e WITH e.idemploye = gc.idemploye '
                                . 'LEFT JOIN AppBundle:Client cli WITH c.idclient = cli.idclient '
                                . 'WHERE c.statut = :statut AND e.idemploye = :idemploye ');
        $query->setParameter('statut', $statut);
        $query->setParameter('idemploye', $idemploye);
        return $query->getArrayResult();
    }

}
