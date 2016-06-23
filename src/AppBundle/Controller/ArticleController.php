<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use AppBundle\Repository\EmployeRepository;
use AppBundle\Enumeration\StatutEmployeEnum;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     * @Route("/", name="article_index")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request)
    {
        $recherche = $request->request->get('recherche');
        $em = $this->getDoctrine()->getManager();
        
        $employeRepo = new EmployeRepository($em);
        $employeRepo->verifierConnexionEmploye(StatutEmployeEnum::MANAGER);
        
        $articles_select = $em->getRepository('AppBundle:Article')->findBy([], ['nom' => 'ASC']);
        $isFiltred = false;
       
        if($recherche != null) {
            $articles = $em->getRepository('AppBundle:Article')->findBy(['idarticle' => $recherche]);
            $isFiltred = true;
        } else {
            $articles = $articles_select;
        }
        return $this->render('article/liste_articles.html.twig',
                ['articles' => $articles,
                'articles_select' => $articles_select,
                'filtre' => $isFiltred,
                'active' => 'A']);
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/new", name="article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('AppBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setNom($form->get('nom')->getData());
            $article->setPoids($form->get('poids')->getData());
            $em->persist($article);
            $em->flush();

            $articles = $em->getRepository('AppBundle:Article')->findAll();
            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', ['article' => $article,'form' => $form->createView()]);
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return $this->render('article/show.html.twig', array(
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
        ));
    }
*/
    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article $article)
    {
        $editForm = $this->createForm('AppBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Article')->findAll();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('article_index');
        
    }

    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
