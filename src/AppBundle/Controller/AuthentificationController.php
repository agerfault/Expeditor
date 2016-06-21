<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
    public function indexAction(Request $request)
    {
        $identifiant = $request->request->get('identifiant');
        $motDePasse = $request->request->get('motDePasse');
        
        $em = $this->getDoctrine()->getManager();

        return $this->render('commande/liste_commandes.html.twig', ['commandes' => $commandes, 'employes' => $employes, 'active' => 'C']);
    }
}
