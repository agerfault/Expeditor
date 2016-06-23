<?php

namespace AppBundle\Controller;

use AppBundle\DTO\Importation;
use AppBundle\Entity\Commande;
use AppBundle\Form\CommandeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Employe;
use AppBundle\Repository\CommandeRepository;
use AppBundle\Tools\ImportFichier;
use AppBundle\Repository\EmployeRepository;
use AppBundle\Enumeration\StatutEmployeEnum;

/**
 * Commande controller.
 *
 * @Route("/commande")
 */
class CommandeController extends Controller {

    /**
     * Import a Commande entity.
     *
     * @Route("/import", name="commande_import")
     * @Method("POST")
     */
    public function importAction(Request $request) {
        $em = $this->getDoctrine()->getManager();


        $import = new Importation();


        $importation = $import->import_commande($request->files->get('file'));

        $compteur = 0;
        foreach ($importation as $ligne) {
            $compteur = $compteur + 1;
            if ($compteur == 1) {
                $this->import_client($ligne, $em);
            }
            if ($compteur == 2) {
                $this->import_commande($ligne, $em);
            }
            if ($compteur == 3) {
                $this->import_article($ligne, $em);
            }
        }

        return $this->redirectToRoute('commande_index');
    }

    private function import_client($ligne, $em) {
        foreach ($ligne as $client) {
            $c = $em->getRepository('AppBundle:Client')->findOneBy(array(
                'nom' => $client->getNom()
            ));
            if ($c == null) {
                $em->persist($client);
            }
        }
        $em->flush();
    }

    private function import_commande($ligne, $em) {
        foreach ($ligne as $commande) {
            $date = new \DateTime($commande->getDate());
            $date->format('Y-m-d H:i:s');

            $c = $em->getRepository('AppBundle:Client')->findOneBy(array(
                'nom' => $commande->getClient()
            ));
            if ($c != null) {
                $new_commande = new Commande();
                $new_commande->setDate($date);
                $new_commande->setIdclient($c);
                $new_commande->setStatut($commande->getStatut());


                $commande_existe = $em->getRepository('AppBundle:Commande')->findOneBy(array(
                    'date' => $date,
                    'idclient' => $c->getIdClient()
                ));
                if ($commande_existe == null) {
                    $em->persist($new_commande);
                }
            }
        }
        $em->flush();
    }

    private function import_article($ligne, $em) {
        foreach ($ligne as $lignesArticle) {
            $date = new \DateTime($lignesArticle->getDate());
            $date->format('Y-m-d H:i:s');
            $c2 = $em->getRepository('AppBundle:Client')->findOneBy(array(
                'nom' => $lignesArticle->getClient()
            ));
            $com = $em->getRepository('AppBundle:Commande')->findOneBy(array(
                'idclient' => $c2->getIdClient(),
                'date' => $date,
            ));
            $art = $em->getRepository('AppBundle:Article')->findOneBy(array(
                'nom' => trim($lignesArticle->getArticle()),
            ));

            $lignearticle = new \AppBundle\Entity\Lignearticle();
            $lignearticle->setQuantite($lignesArticle->getQuantite());
            $lignearticle->setIdcommande($com);
            $lignearticle->setIdarticle($art);


            $lignearticle_existe = $em->getRepository('AppBundle:Lignearticle')->findOneBy(array(
                'quantite' => $lignesArticle->getQuantite(),
                'idcommande' => $lignearticle->getIdcommande()->getIdCommande(),
                'idarticle' => $lignearticle->getIdarticle()->getIdarticle(),
            ));
            if ($lignearticle_existe == null) {
                $em->persist($lignearticle);
            }
        }
        $em->flush();
    }

    /* public function indexAction() {
      $em = $this->getDoctrine()->getManager();

      $commandes = $em->getRepository('AppBundle:Gestioncommande')->findAll();
      $employes = $em->getRepository('AppBundle:Employe')->findAll();

      return $this->render('commande/liste_commandes.html.twig', ['commandes' => $commandes, 'employes' => $employes, 'active' => 'C']);
      } */

    /**
     * Lists all Commande entities.
     *
     * @Route("/", name="commande_index")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request) {
        $recherche = $request->request->get('recherche');
        $em = $this->getDoctrine()->getManager();
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::MANAGER);
        
        $commandeRepository = new CommandeRepository($em);
        $commandes = $commandeRepository->findAllCommandes();

        $repoEmploye = $em->getRepository('AppBundle:Employe');
        $employes = $repoEmploye->findAll();
        $isFiltred = false;

        if ($recherche != null) {
            $commandes = $commandeRepository->findCommandesByIdEmploye($recherche);
            //$commandes = $em->getRepository('AppBundle:Commande')->findBy(['idemploye' => $recherche]);
            $isFiltred = true;
        }

        return $this->render('commande/liste_commandes.html.twig', ['commandes' => $commandes,
                    'filtre' => $isFiltred,
                    'employes' => $employes,
                    'statut' => null,
                    'active' => 'C']);
    }

    /**
     * Lists all Commande entities.
     *
     * @Route("/filtre/{statut}", name="commande_index_filtred")
     * @Method({"POST", "GET"})
     */
    public function indexfiltredAction(Request $request, $statut) {
        if ($statut != 'ALL') {
            $recherche = $request->request->get('recherche');
            $em = $this->getDoctrine()->getManager();
            $commandeRepository = new CommandeRepository($em);

            $commandes = $commandeRepository->findCommandesByStatut($statut);

            $repoEmploye = $em->getRepository('AppBundle:Employe');
            $employes = $repoEmploye->findAll();
            $isFiltred = false;

            if ($recherche != null) {
                $commandes = $commandeRepository->findCommandesByStatutAndIdEmploye($statut, $recherche);
                //$commandes = $em->getRepository('AppBundle:Commande')->findBy(['idemploye' => $recherche]);
                $isFiltred = true;
            }

            return $this->render('commande/liste_commandes.html.twig', ['commandes' => $commandes,
                        'filtre' => $isFiltred,
                        'employes' => $employes,
                        'statut' => $statut,
                        'active' => 'C']);
        } else {
            return $this->redirectToRoute('commande_index');
        }
    }

    /**
     * Creates a new Commande entity.
     *
     * @Route("/new", name="commande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $commande = new Commande();
        $form = $this->createForm('AppBundle\Form\CommandeType', $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_show', array('id' => $commande->getId()));
        }

        return $this->render('commande/new.html.twig', array(
                    'commande' => $commande,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Commande entity.
     *
     * @Route("/{id}", name="commande_show")
     * @Method("GET")
     */
    public function showAction(Commande $commande) {
        $deleteForm = $this->createDeleteForm($commande);

        return $this->render('commande/show.html.twig', array(
                    'commande' => $commande,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commande entity.
     *
     * @Route("/{id}/edit", name="commande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commande $commande) {
        $deleteForm = $this->createDeleteForm($commande);
        $editForm = $this->createForm('AppBundle\Form\CommandeType', $commande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/edit.html.twig', array(
                    'commande' => $commande,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Commande entity.
     *
     * @Route("/{id}", name="commande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commande $commande) {
        $form = $this->createDeleteForm($commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commande);
            $em->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * Creates a form to delete a Commande entity.
     *
     * @param Commande $commande The Commande entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Commande $commande) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('commande_delete', array('id' => $commande->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
