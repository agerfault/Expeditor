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

    
    public function insertCommande($date,$statut,$idclient) {
        $query = $this->getEntityManager()
                        ->createQuery(
                'INSERT INTO AppBundle:Commande(date,statut,idclient) VALUES(?,?,?)')
                ->setParameter(1, $date)
                ->setParameter(2, $statut)
                ->setParameter(3, $idclient);
        return $query->execute();
    }
}
