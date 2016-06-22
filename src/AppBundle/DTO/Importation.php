<?php

namespace AppBundle\DTO;

use \Symfony\Component\Config\Definition\Exception\Exception;
use AppBundle\Entity\Client;
use AppBundle\DTO\CommandeImport;

/**
 * Description of Importation
 *
 * @author d1412mercierc
 */
class Importation {

    const STATUT = 'EA';
    const SEPARATEUR = ',';
    const TYPE_OUVERTURE_FICHIER = 'r';
    const FORMAT_DATE = 'd/m/y';
    // PATERN 
    const PATTERN_QTE = '/[0-9]{1,}/';
    const PATTERN_ARTICLE = "#[a-zA-Z0-9éèà\s]{1,}\(#";
    // EXCEPTION 
    const EXCEPTION_OUVERTURE_FICHIER = "Impossible d'ouvrir le fichier à importer.";
    const EXCEPTION_FICHIER_NON_EXISTANT = "Le fichier à importer n'existe pas.";

    // JOURNALISATION

    /**
     * @param string $fichier Fichier sur le quel on cherche a vérifier son existance.
     * @return Ressource Pointer sur ressource.
     * @throws Exception Erreur de lecture du fichier
     */
    public function etatFichier($fichier) {
        // Verification si le fichier existe
        if (file_exists($fichier)) {
            $handle = fopen($fichier, self::TYPE_OUVERTURE_FICHIER);
            // Verification si le fichier à bien été ouvert
            if ($handle) {
                return $handle;
            } else {
                throw new Exception("Impossible d'ouvrir le fichier à importer.", 400);
            }
        } else {
            throw new Exception("Le fichier à importer n'existe pas.", 400);
        }
    }

    public function import_commande($fichier) {
        $import = array();
        $commandes = array();
        $clients = array();
        $lignearticle = array();

        // Verification sur le fichier
        $handle = $this->etatFichier($fichier);

        fgets($handle);
        // Boucle tant que l'on est pas sur la derniere ligne du fichier
        while (!feof($handle)) {
            // Decoupe de la ligne
            $colonnes = explode(self::SEPARATEUR, fgets($handle));
            if (!empty($colonnes[1])) {
                $client = new Client($colonnes[2], $colonnes[3]);
                $commande = new CommandeImport(utf8_encode($colonnes[0]), utf8_encode($colonnes[2]), self::STATUT);

                $resultat = array();
                $lignes = explode(';', $colonnes[4]);
                foreach ($lignes as $ligne) {
                    preg_match(self::PATTERN_QTE, $ligne, $resultat);
                    if ($resultat != null) {
                        $qte = $resultat[0];
                    }
                    $resultat = array();
                    preg_match(self::PATTERN_ARTICLE, $ligne, $resultat);
                    if ($resultat != null) {
                        $article = substr($resultat[0], 0, strlen($resultat[0]) - 2);
                    }
                    
                    if ($qte != null && $article != null) {
                        $ligneArticleImport = new LigneArticleImport($qte, $article, $colonnes[0], $colonnes[2]);
                    }
                    array_push($lignearticle, $ligneArticleImport);
                }
                array_push($commandes, $commande);
                array_push($clients, $client);
            }
        }

        
        array_push($import, $clients);
        array_push($import, $commandes);
        array_push($import, $lignearticle);
        fclose($handle);
        return $import;
    }

}
