<?php

namespace AppBundle\Controller;

use HTML2PDF;
use Html2Pdf_Html2Pdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use \AppBundle\Entity\Commande;

/**
 * Description of PDFController
 *
 * @author Kevin Desmay
 * @Route("/PDF")
 */
class PDFController extends Controller {

    /**
     * Edit a delivery
     *
     * @Route("/", name="pdf_index")
     * @Method("GET")
     */
    public function indexAction() {
        return new Response('test_pdf');
    }

    /**
     * Edit a delivery
     *
     * @Route("/bonlivraison/{commande_id}", requirements={"commande_id" = "\d+"} ,name="pdf_bonlivraison")
     * @Method("GET")
     */
    public function bonLivraisonAction($commande_id) {
        $em = $this->getDoctrine()->getManager();

        $commande = $em->getRepository('AppBundle:Commande')->findOneBy(array('idcommande' => $commande_id));
        $client =  $em->getRepository('AppBundle:Client')->findOneBy(array('idclient' => $commande->getIdClient()));
        $lignes = $em->getRepository('AppBundle:Lignearticle')->findBy(array('idcommande' => $commande->getIdCommande()));
        
        
        $poids = 0;
        foreach ($lignes as $ligne) {
            $poids += $ligne->getIdArticle()->getPoids();
        }
        
        $html = $this->renderView('pdf/bonlivraison.html.twig',
                array('commande' => $commande,
                    'client' => $client,
                    'lignes' => $lignes,
                    'poids' => $poids,
                ));

        $html2pdf = new Html2Pdf_Html2Pdf('P', 'A4', 'fr');

        
        $html2pdf->WriteHTML($html);
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->Output('exemple.pdf');

        $response = new Response('test');
        return $response;
    }

}
