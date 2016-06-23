<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Employe;
use AppBundle\Form\EmployeType;
use AppBundle\Repository\GestioncommandeRepository;

use AppBundle\Repository\EmployeRepository;
use AppBundle\Enumeration\StatutEmployeEnum;


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
     * @Method({"POST", "GET"}) (répliquer sur ce controller la recherche)
     */
    public function indexAction(Request $request)
    {   
        $recherche = $request->request->get('recherche');
        $em = $this->getDoctrine()->getManager();
        
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::MANAGER);
        
        
        $employes_select = $em->getRepository('AppBundle:Employe')->findBy([], ['statut' => 'DESC']);
        $isFiltred = false;
        
        if($recherche != null) {
            $employes = $em->getRepository('AppBundle:Employe')->findBy(['idemploye' => $recherche]);
            $isFiltred = true;
        } else {
            $employes = $employes_select;
        }
        
        $gestionCommandeEmplRepository = new GestioncommandeRepository($em);
        
        foreach ($employes as $key => $unemp) {
            $gestioncommandesEmpl[$unemp->getIdemploye()] =  $gestionCommandeEmplRepository->NbCmdTraiteEmployeDuJour($unemp);
        }
        
        return $this->render('employe/liste_employes.html.twig', [ 
            'nbcommandetraite' => $gestioncommandesEmpl,
            'employes' => $employes, 
            'filtre' => $isFiltred, 
            'active' => 'E']);
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
        
        $em = $this->getDoctrine()->getManager();
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::MANAGER);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $employe->setMotdepasse(md5($employe->getMotdepasse()));
            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('employe_index');
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
    
    public function showAction(Employe $employe)
    {
        $deleteForm = $this->createDeleteForm($employe);

        return $this->render('employe/show.html.twig', array(
            'employe' => $employe,
            'delete_form' => $deleteForm->createView(),
        ));
    }
 */
    /**
     * Displays a form to edit an existing Employe entity.
     *
     * @Route("/{id}/edit", name="employe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employe $employe)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::MANAGER);
        
        
        $editForm = $this->createForm('AppBundle\Form\EmployeType', $employe);
        $editForm->handleRequest($request);
        if (!$editForm->isSubmitted()) {
            $employe->setMotdepasse('');
            $editForm = $this->createForm('AppBundle\Form\EmployeType', $employe);
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $employe->setMotdepasse(md5($employe->getMotdepasse()));
            $em->persist($employe);
            $em->flush();

            return $this->redirectToRoute('employe_index');
        }
        return $this->render('employe/edit.html.twig', ['employe' => $employe, 'edit_form' => $editForm->createView()]);
    }

    /**
     * Deletes a Employe entity.
     *
     * @Route("/{id}", name="employe_delete")
     * @Method({"GET", "POST", "DELETE"})
     */
    public function deleteAction(Request $request, Employe $employe)
    {
        $em = $this->getDoctrine()->getManager();
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::MANAGER);
        
        $em->getRepository('AppBundle:Employe')->findAll();
        $em->remove($employe);
        $em->flush();

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
