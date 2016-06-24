<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Gestioncommande;
use AppBundle\Form\GestioncommandeType;
use AppBundle\Repository\GestioncommandeRepository;
use AppBundle\Repository\EmployeRepository;
use AppBundle\Enumeration\StatutEmployeEnum;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Gestioncommande controller.
 *
 * @Route("/gestioncommande")
 */
class GestioncommandeController extends Controller {

    /**
     * Lists all Gestioncommande entities.
     *
     * @Route("/", name="gestioncommande_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()
                ->getManager();

        $session = new Session();
        $employe = $session->get('employe');
        try{    
            $employeRepo = new EmployeRepository($em);
            $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::EMPLOYE);
        }
        catch(\Exception $ex){
            $this->addFlash('erreur', $ex->getMessage());
            return $this->redirectToRoute('homepage');
        }
        
        $gestionCommandeRepository = new GestioncommandeRepository($em);
        
        $gestioncommandes = $gestionCommandeRepository->getCommandeEnCoursEmp($employe->getIdemploye());
        
        if($gestioncommandes)
        {
            $gestioncommandes = $gestionCommandeRepository->findCommandeEnCoursEmp($gestioncommandes[0][1]);
        }
        else
        {
            $gestioncommandes = $gestionCommandeRepository->findCommandeEnAttente();

            if (!$gestioncommandes) {
                return $this->render('commande/aucune_commande.html.twig', array());
            }else{
                $gestionCommandeRepository->changerStatutCommande('EC', $gestioncommandes[0]['idcommande']);

                $date = new \DateTime();

                try {
                    $gestionCommandeRepository->insertCdeEmp($employe->getIdemploye(), $gestioncommandes[0]['idcommande'], $date->format('Y-m-d H:i:s'));
                } catch (\Exception $ex) {
                    $this->addFlash('erreur', $ex->getMessage());
                }
            }
        
        }
        
            return $this->render('gestioncommande/index.html.twig', array(
                        'gestioncommandes' => $gestioncommandes,
            ));
        
    }

    /**
     * Valider la saisie de la commande de l'employé
     *
     * @Route("/validerCommande", name="validerCommande")
     * @Method({"GET","POST"})
     */
    public function validerCommandeAction(Request $request) {
        $idCde = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();
        //Récupération de la première commande non traité
        $ligneArticle = $em->getRepository('AppBundle:Lignearticle')->findBy(['idcommande' => $idCde]);

        $tabElementsSaisis = $request->request->all();
        $i = 0;

        foreach ($ligneArticle as $maLigne) {
            if ($maLigne->getQuantite() == $tabElementsSaisis['articles'][$i]) {
                $i++;
            } else {
                $this->addFlash('erreur', 'Merci de vérifier les quantités saisies');
                $gestionCommandeRepository = new GestioncommandeRepository($em);
                $gestionCommandeRepository->changerStatutCommande('EA', $idCde);

                return $this->redirectToRoute('gestioncommande_index');
            }
        }
        $gestionCommandeRepository = new GestioncommandeRepository($em);
        $gestionCommandeRepository->changerStatutCommande('T', $idCde);

        return $this->render('gestioncommande/impression_bl.html.twig', ['idCde' => $idCde]);
    }

    /**
     * Creates a new Gestioncommande entity.
     *
     * @Route("/new", name="gestioncommande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $gestioncommande = new Gestioncommande();
        $form = $this->createForm('AppBundle\Form\GestioncommandeType', $gestioncommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gestioncommande);
            $em->flush();

            return $this->redirectToRoute('gestioncommande_show', array('id' => $gestioncommande->getId()));
        }

        return $this->render('gestioncommande/new.html.twig', array(
                    'gestioncommande' => $gestioncommande,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gestioncommande entity.
     *
     * @Route("/{id}/edit", name="gestioncommande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gestioncommande $gestioncommande) {
        $new_affectation = $request->request->get('affectation');
        $em = $this->getDoctrine()->getManager();
        $employes = $em->getRepository('AppBundle:Employe')->findAll();

        if ($new_affectation != null) {
            $employe = $em->getRepository('AppBundle:Employe')->findBy(['idemploye' => $new_affectation])[0];
            $em->getRepository('AppBundle:Gestioncommande');
            $gestioncommande->setIdemploye($employe);
            $em->persist($gestioncommande);
            $em->flush();
            return $this->redirectToRoute('commande_index');
        }

        return $this->render('gestioncommande/edit.html.twig', ['employes' => $employes,
                    'idcommande' => $gestioncommande->getIdgestioncommande()]);
    }
    
    
    
    /**
     * @Route("/{id}/liberercommande", name="liberer_commande")
     * @Method({"GET", "POST"})
     */
    public function libererCommandeAction(Request $request, Gestioncommande $gestioncommande)
    {
        $em = $this->getDoctrine()->getManager();
        $gestioncommande->getIdcommande()->setStatut('EA');
        $em->persist($gestioncommande->getIdcommande());
        $em->remove($gestioncommande);
        $em->flush();
        return $this->redirectToRoute('commande_index');
    }

}
