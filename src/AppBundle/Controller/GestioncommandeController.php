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

/**
 * Gestioncommande controller.
 *
 * @Route("/gestioncommande")
 */
class GestioncommandeController extends Controller
{
    /**
     * Lists all Gestioncommande entities.
     *
     * @Route("/", name="gestioncommande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
		  $em = $this ->getDoctrine()
                              ->getManager();
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::EMPLOYE);
                  
        $gestionCommandeRepository = new GestioncommandeRepository($em);
        $gestioncommandes =  $gestionCommandeRepository->findCommandeEnAttente();
		
		if (!$gestioncommandes)
		{
			var_dump('Sorry bro\' T O chomage teknik !');
			exit();
		}
		else
		{
			$gestionCommandeRepository->changerStatutCommande('EC',$gestioncommandes[0]['idcommande']);
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
    public function validerCommandeAction(Request $request)
    {
		 $idCde = $request->query->get('id');
		 
        $em = $this->getDoctrine()->getManager();
        //Récupération de la première commande non traité
	    $ligneArticle = $em->getRepository('AppBundle:Lignearticle')->findBy(['idcommande' => $idCde]);
		
		$tabElementsSaisis = $request->request->all();
		$i=0;
		
        foreach($ligneArticle as $maLigne)
        {
                if($maLigne->getQuantite() == $tabElementsSaisis['articles'][$i])
                {
					$gestionCommandeRepository = new GestioncommandeRepository($em);
					$gestionCommandeRepository->changerStatutCommande('T',$idCde);
					//return $this->redirectToRoute('pdf_bonlivraison', ['commande_id' => $idCde]);
					
                    return $this->render('gestioncommande/impression_bl.html.twig',['idCde' => $idCde]);
					//redirectToRoute('gestioncommande_index');
                }
                else
                {
					$this->addFlash('erreur', 'Merci de vérifier les quantités saisies');
					$gestionCommandeRepository = new GestioncommandeRepository($em);
					$gestionCommandeRepository->changerStatutCommande('EA',$idCde);

                    return $this->redirectToRoute('gestioncommande_index');
                }
				$i++;
        }    
    }


    /**
     * Creates a new Gestioncommande entity.
     *
     * @Route("/new", name="gestioncommande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
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
     * Finds and displays a Gestioncommande entity.
     *
     * @Route("/{id}", name="gestioncommande_show")
     * @Method("GET")
     */
    public function showAction(Gestioncommande $gestioncommande)
    {
        $deleteForm = $this->createDeleteForm($gestioncommande);

        return $this->render('gestioncommande/show.html.twig', array(
            'gestioncommande' => $gestioncommande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gestioncommande entity.
     *
     * @Route("/{id}/edit", name="gestioncommande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gestioncommande $gestioncommande)
    {
        $deleteForm = $this->createDeleteForm($gestioncommande);
        $editForm = $this->createForm('AppBundle\Form\GestioncommandeType', $gestioncommande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gestioncommande);
            $em->flush();

            return $this->redirectToRoute('gestioncommande_edit', array('id' => $gestioncommande->getId()));
        }

        return $this->render('gestioncommande/edit.html.twig', array(
            'gestioncommande' => $gestioncommande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Gestioncommande entity.
     *
     * @Route("/{id}", name="gestioncommande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gestioncommande $gestioncommande)
    {
        $form = $this->createDeleteForm($gestioncommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gestioncommande);
            $em->flush();
        }

        return $this->redirectToRoute('gestioncommande_index');
    }

    /**
     * Creates a form to delete a Gestioncommande entity.
     *
     * @param Gestioncommande $gestioncommande The Gestioncommande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gestioncommande $gestioncommande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gestioncommande_delete', array('id' => $gestioncommande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
