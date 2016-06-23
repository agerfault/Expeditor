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
     * Liste des commandes réalisé par l'employé passé en param
     */
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->_em = $em;
    }
    
    /*
     * Récupération des commandes que l'employé a traité
     */
    public function LstCommandeEmploye(Employe $Emp) {
        
        $query = $this->_em()->createQuery(
                            'SELECT gc, e '
                                . 'FROM AppBundle:Gestioncommande gc '
                                . 'JOIN gc.idemploye e '
                                . 'WHERE e.idemploye = :emplo');
        $query->setParameter('emplo', $Emp->getIdemploye());
        return $query->getArrayResult();
    }
    
    /*
     * Récupération des commandes que l'employé a traité
     */
    public function LstCommandeEmployeparDate(Employe $Emp, DateTime $date) {
        
        $query = $this->_em()->createQuery(
                            'SELECT gc, e '
                                . 'FROM AppBundle:Gestioncommande gc '
                                . 'JOIN gc.idemploye e '
                                . 'WHERE e.idemploye = :emplo'
                                . 'AND gc.date = :dat');
        $query->setParameter('emplo', $Emp->getIdemploye());
        $query->setParameter('dat', $date);
        return $query->getArrayResult();
    }
    
    
    /*
     * Récupération des commandes que l'employé a traité
     */
    public function NbCmdTraiteEmployeDuJour(Employe $Emp) {
        $dateduj =  new \DateTime();
        
        $dateforma = $dateduj->format("Y-m-d");
        $query = $this->_em->createQuery(
                            'SELECT COUNT(gc) '
                                . 'FROM AppBundle:Gestioncommande gc '
                                . 'JOIN gc.idcommande c '
                                . 'WHERE gc.idemploye = :emplo '
                                . 'AND gc.date LIKE :dat '
                                . 'AND c.statut = :stat');
        $query->setParameter('emplo', $Emp->getIdemploye());
        $query->setParameter('dat', $dateforma.'%');
        $query->setParameter('stat', 'T');
        return $query->getSingleResult();
    }
    
    
    /*
     * Récupération d'un tableau pour la gestion des commandes
     */
    public function findCommandeEnAttente() {
            $id = 'SELECT cmd.idcommande '
                    . 'FROM AppBundle:Commande cmd '
                    . 'WHERE cmd.statut = :statut order by cmd.date ASC ';
            
            $query = $this->_em->createQuery($id);
            $query->setParameter('statut', 'EA');
            $id = $query->setMaxResults(1)->getResult();
		
		$sql = 'SELECT  cmd.idcommande, cmd.date,
                                cli.nom as nomClient, cli.adresse,
                                art.idarticle, art.nom, art.poids,
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
	
	public function changerStatutCommande($statut, $idcde) {

		 $id = 'UPDATE AppBundle:Commande cmd '
                    . 'SET cmd.statut = :statut '
                    . 'WHERE cmd.idcommande = :idcde';
            
            $query = $this->_em->createQuery($id);
            $query->setParameter('statut', $statut);
			$query->setParameter('idcde', $idcde);
			$query->execute();
			
	 }
	 
	 
    public function getCommandeEnCoursEmp($idemp) {

			$numcde = 'SELECT IDENTITY (gc.idcommande) '
			.'FROM AppBundle:Gestioncommande gc, '
                             .'AppBundle:Commande cde '
                        .'WHERE cde.idcommande = gc.idcommande '
                        .'AND cde.statut = \'EC\' '       
			.'AND gc.idemploye = :idemp ';

			$query = $this->_em->createQuery($numcde);
                        $query->setParameter('idemp', $idemp);
			
			return $query->getResult();
    }
    
    
    public function insertCdeEmp($idemp, $idcommande, $date){
        
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "expeditor";

        // Create connection
        $conn = new \mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $gestCde = 'insert into Gestioncommande (IdEmploye,IdCommande,Date) '
                    . 'values ('.$idemp.', '.$idcommande.', \''.$date.'\');';

        if ($conn->query($gestCde) === TRUE) {
            
        } else {
            throw new \Exception("Error: " . $gestCde . "<br>" . $conn->error);
        }

        $conn->close();

    }
    
     public function supprimerGestionCommande($idemp, $idcde) {

			$numcde = 'DELETE AppBundle:Gestioncommande gc '
                        .'WHERE gc.idemploye = :idemp '
                       . 'AND gc.idcommande = :idcde ';

			$query = $this->_em->createQuery($numcde);
                        $query->setParameter('idemp', $idemp);
                        $query->setParameter('idcde', $idcde);
			
			return $query->execute();
    }

}
