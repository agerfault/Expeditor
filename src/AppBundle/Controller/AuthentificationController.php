<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Repository\EmployeRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Enumeration\StatutEmployeEnum;
use AppBundle\Repository\GestioncommandeRepository;

/**
 * Description of AuthentificationController
 *
 * @author Alexandre
 */
class AuthentificationController extends Controller {
    
    /**
     * Permet à un employé ou un manager de se connecter.
     *
     * @Route("/se-connecter", name="seConnecter")
     * @Method("POST")
     */
    public function seConnecterAction(Request $request)
    {
        $identifiant = $request->request->get('identifiant');
        $motDePasse = $request->request->get('motDePasse');
        
        $em = $this->getDoctrine()->getManager();
        
        try{
            $employeRepository = new EmployeRepository($em);
            $employeRepository->connecterEmploye($identifiant, $motDePasse);
        } catch (\Exception $ex) {
            $this->addFlash('erreur', $ex->getMessage());
        }
        
        return $this->redirectToRoute('homepage');
    }
    
    /**
     * Permet à un employé ou un manager de se déconnecter.
     * 
     * @Route("/se-deconnecter", name="seDeconnecter")
     * @Method("GET")
     */
    public function seDeconnecterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        try{
			$session = new Session();
			$employe = $session->get('employe');
			if(!$employe){
				$this->addFlash('erreur', 'Pas d\'employe connecté');
			}
			else{
				if($employe->getStatut() == StatutEmployeEnum::EMPLOYE){
                                    $gestionCommandeRepo = new GestioncommandeRepository($em);
                                    $commande = $gestionCommandeRepo->getCommandeEnCoursEmp($employe->getIdemploye());
                                    $gestionCommandeRepo->changerStatutCommande('EA', $commande[0][1]);
                                    $gestionCommandeRepo->supprimerGestionCommande($employe->getIdemploye(),$commande[0][1]);
				}
			}
            $employeRepository = new EmployeRepository($em);
            $employeRepository->deconnecterEmploye();
        } catch (\Exception $ex) {
            $this->addFlash('erreur', $ex->getMessage());
        }
        
        return $this->redirectToRoute('homepage');
    }
}
