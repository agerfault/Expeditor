<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Employe;
use AppBundle\Form\EmployeType;

/**
 * Employe controller.
 *
 * @Route("/employe")
 */
class EmployeController extends Controller
{
    /**
     * Lists all Employe entities.
     *
     * @Route("/", name="employe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employes = $em->getRepository('AppBundle:Employe')->findAll();

        return $this->render('employe/index.html.twig', array(
            'employes' => $employes,
        ));
    }

    /**
     * Creates a new Employe entity.
     *
     * @Route("/new", name="employe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employe = new Employe();
        $form = $this->createForm('AppBundle\Form\EmployeType', $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('employe_show', array('id' => $employe->getId()));
        }

        return $this->render('employe/new.html.twig', array(
            'employe' => $employe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Employe entity.
     *
     * @Route("/{id}", name="employe_show")
     * @Method("GET")
     */
    public function showAction(Employe $employe)
    {
        $deleteForm = $this->createDeleteForm($employe);

        return $this->render('employe/show.html.twig', array(
            'employe' => $employe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Employe entity.
     *
     * @Route("/{id}/edit", name="employe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employe $employe)
    {
        $deleteForm = $this->createDeleteForm($employe);
        $editForm = $this->createForm('AppBundle\Form\EmployeType', $employe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('employe_edit', array('id' => $employe->getId()));
        }

        return $this->render('employe/edit.html.twig', array(
            'employe' => $employe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Employe entity.
     *
     * @Route("/{id}", name="employe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employe $employe)
    {
        $form = $this->createDeleteForm($employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employe);
            $em->flush();
        }

        return $this->redirectToRoute('employe_index');
    }

    /**
     * Creates a form to delete a Employe entity.
     *
     * @param Employe $employe The Employe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employe $employe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employe_delete', array('id' => $employe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
