<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Employe;

/**
 * Gestioncommande
 */
class GestioncommandeRepository
{
    protected $_em;
    /*
     * Liste des commandes r�alis� par l'employ� pass� en param
     */
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->_em = $em;
    }
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
	
	
	/*
     * R�cup�ration d'un tableau pour la gestion des commandes
     */
    public function findCommandeEnAttente() {
            $id = 'SELECT cmd2.idcommande '
                    . 'FROM AppBundle:Commande cmd2 '
                    . 'WHERE cmd2.statut = :statut order by cmd2.date ASC ';
            
            $query = $this->_em->createQuery($id);
            $query->setParameter('statut', 'EA');
            $id = $query->setMaxResults(1)->getResult();
        
		$sql = 'SELECT  cmd.idcommande, cmd.date,
                                cli.nom, cli.adresse,
                                art.nom, art.poids,
                                la.quantite
                       FROM AppBundle:Commande cmd,
                            AppBundle:Client cli,
                            AppBundle:Lignearticle la,
                            AppBundle:Article art
                       WHERE cli.idclient = cmd.idclient
                       AND la.idcommande = cmd.idcommande
                       AND art.idarticle = la.idarticle
                       AND cmd.statut = :statut
                       AND cmd.idcommande = :id';
		
        $query = $this->_em->createQuery($sql);
        $query->setParameter('statut', 'EA');
        $query->setParameter('id', $id);
        return $query->getResult();
    }
    
    
}
