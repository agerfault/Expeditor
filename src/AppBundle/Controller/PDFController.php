<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Lignearticle;
use AppBundle\Form\LignearticleType;
use AppBundle\Tools\html2pdf\_class;

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
     * @Route("/bonlivraison", name="pdf_bonlivraison")
     * @Method("GET")
     */
    public function bonLivraisonAction() {
        
        
    $content = "
<page>
    <h1>Exemple d'utilisation</h1>
    <br>
    Ceci est un <b>exemple d'utilisation</b>
    de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
</page>";
    
        $html2pdf = new HTML2PDF('P','A4','fr');
        
        
    $html2pdf->WriteHTML($content);
    $html2pdf->Output('exemple.pdf');
        
    }
    
}
