<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Gestioncommande;
use AppBundle\Form\GestioncommandeType;

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
        $em = $this->getDoctrine()->getManager();

        $gestioncommandes = $em->getRepository('AppBundle:Gestioncommande')->findAll();

        return $this->render('gestioncommande/index.html.twig', array(
            'gestioncommandes' => $gestioncommandes,
        ));
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
