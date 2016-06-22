<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $session = new Session();
        $employe = $session->get('employe');
        if($employe == null){
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            ]);
        }
        switch($employe->getStatut()){
            case 1 :
                return $this->redirectToRoute('gestioncommande_index');
            case 2 :
                return $this->redirectToRoute('commande_index');
            default :
                return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
                ]);
        }
    }
}
