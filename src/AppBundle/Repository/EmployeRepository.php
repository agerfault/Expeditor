<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Repository;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of EmployeRepository
 *
 * @author Administrateur
 */
class EmployeRepository {
    
    protected $_em;
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->_em = $em;
    }
    
    public function connecterEmploye($identifiant, $motDePasse){
        if(trim($identifiant) == null){
            throw new \Exception("L'identifiant ne peut être vide");
        }
        if(trim($motDePasse) == null){
            throw new \Exception("Le mot de passe ne peut être vide");
        }
        $employe = $this->_em->getRepository('AppBundle:Employe')->findOneBy(['nom' => $identifiant, 'motdepasse' => md5($motDePasse)]);
        if($employe == null){
            throw new \Exception("Identifiant ou mot de passe incorrect");
        }
        $session = new Session();
        $session->set('employe', $employe);
        return $employe;
    }
    
    public function deconnecterEmploye(){
        $session = new Session();
        $employe = $session->get('employe');
        if($employe == null){
            throw new \Exception("Aucun employe connecté");
        }
        $session->remove('employe');
    }
    
    public function verifierConnexionEmploye($statut){
        $session = new Session();
        $employe = $session->get('employe');
        if($employe == null){
            throw new AccessDeniedException('Vous n\'avez pas la permission d\'accéder à cette page.');
        }
        if($employe->getStatut() != $statut){
            throw new AccessDeniedException('Vous n\'avez pas la permission d\'accéder à cette page.');
        }
    }
}
