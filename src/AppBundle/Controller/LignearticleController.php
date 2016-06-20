<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Lignearticle;
use AppBundle\Form\LignearticleType;

/**
 * Lignearticle controller.
 *
 * @Route("/lignearticle")
 */
class LignearticleController extends Controller
{
    /**
     * Lists all Lignearticle entities.
     *
     * @Route("/", name="lignearticle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lignearticles = $em->getRepository('AppBundle:Lignearticle')->findAll();

        return $this->render('lignearticle/index.html.twig', array(
            'lignearticles' => $lignearticles,
        ));
    }

    /**
     * Creates a new Lignearticle entity.
     *
     * @Route("/new", name="lignearticle_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lignearticle = new Lignearticle();
        $form = $this->createForm('AppBundle\Form\LignearticleType', $lignearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lignearticle);
            $em->flush();

            return $this->redirectToRoute('lignearticle_show', array('id' => $lignearticle->getId()));
        }

        return $this->render('lignearticle/new.html.twig', array(
            'lignearticle' => $lignearticle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Lignearticle entity.
     *
     * @Route("/{id}", name="lignearticle_show")
     * @Method("GET")
     */
    public function showAction(Lignearticle $lignearticle)
    {
        $deleteForm = $this->createDeleteForm($lignearticle);

        return $this->render('lignearticle/show.html.twig', array(
            'lignearticle' => $lignearticle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lignearticle entity.
     *
     * @Route("/{id}/edit", name="lignearticle_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lignearticle $lignearticle)
    {
        $deleteForm = $this->createDeleteForm($lignearticle);
        $editForm = $this->createForm('AppBundle\Form\LignearticleType', $lignearticle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lignearticle);
            $em->flush();

            return $this->redirectToRoute('lignearticle_edit', array('id' => $lignearticle->getId()));
        }

        return $this->render('lignearticle/edit.html.twig', array(
            'lignearticle' => $lignearticle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lignearticle entity.
     *
     * @Route("/{id}", name="lignearticle_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lignearticle $lignearticle)
    {
        $form = $this->createDeleteForm($lignearticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lignearticle);
            $em->flush();
        }

        return $this->redirectToRoute('lignearticle_index');
    }

    /**
     * Creates a form to delete a Lignearticle entity.
     *
     * @param Lignearticle $lignearticle The Lignearticle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lignearticle $lignearticle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lignearticle_delete', array('id' => $lignearticle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
