<?php

namespace AppBundle\DTO;

use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * Description of Exportation
 *
 * @author d1412mercierc
 */
class Exportation {
    
    const SEPARATEUR = ';';
    const RETOUR_LIGNE = "\n";
    const TYPE_OUVERTURE_FICHIER = 'w+';
    // PATERN 
    // EXCEPTION
    const EXCEPTION_OUVERTURE_FICHIER = "Impossible d'ouvrir le fichier à exporter.";
    // JOURNALISATION
    const LOG_INFO_START_FILEATTENTE = "Exportation des données dans le fichier : ";
    const LOG_INFO_START_COMPOSANT = "Exportation des données dans le fichier : ";
    const LOG_INFO_OUVERTURE_FICHIER_REUSSIE = "Ouverture du fichier OK";
    const LOG_INFO_SUCCESS = "Exportation OK";
    const LOG_ERREUR_OUVERTURE_FICHIER = "Ouverture du fichier Impossible : ";

    private $logger;

    
    /**
     * Première méthode appelée lors de l'initialisation de l'objet.
     * @param LoggerInterface $logger Journalisation
     */
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    /**
     * Méthode permetant de faire l'exportation des files d'attentes.
     * Elle crée un fichier CSV. Les élements sont séparé par un point virgule
     * @param String $fichier Fichier dans le quel l'export doit être fait.
     * @param Array<FileAttente> $files_attentes Liste des files d'attentes à exporter
     * @date 17/10/2015
     * @version v1.0
     */
    public function export_fileAttente($fichier, $files_attentes) {
        $this->logger->info(self::LOG_INFO_START_FILEATTENTE . $fichier);
        // Crée ou ouvre le fichier 
        $handle = fopen($fichier, self::TYPE_OUVERTURE_FICHIER);
        // Vérifie si le fichier est bien ouvert
        if ($handle) {
            $this->logger->info(self::LOG_INFO_OUVERTURE_FICHIER_REUSSIE);
            // Parcours des files d'attentes
            $this->stringBuilder_EnteteFileAttente($handle);
            foreach ($files_attentes as $file_attente) {
                // Création d'une ligne
                $string_builder = $this->stringBuilder_FileAttente($file_attente);
                fwrite($handle, $string_builder);
                
            }
        } else {
            $this->logger->error(self::LOG_ERREUR_OUVERTURE_FICHIER + $fichier);
            throw new Exception(self::EXCEPTION_OUVERTURE_FICHIER);
        }
        $this->logger->info(self::LOG_INFO_SUCCESS);
    }

    /**
     * Méthode permetant de faire l'exportation des files d'attentes.
     * Elle crée un fichier CSV. Les élements sont séparé par un point virgule
     * @param String $fichier Fichier dans le quel l'export doit être fait.
     * @param Array<Composant> $composants Liste des files d'attentes à exporter
     * @date 17/10/2015
     * @version v1.0
     */
    public function export_composants($fichier, $composants) {
        $this->logger->info(self::LOG_INFO_START_COMPOSANT . $fichier);
        // Crée ou ouvre le fichier 
        $handle = fopen($fichier, self::TYPE_OUVERTURE_FICHIER);
        // Vérifie si le fichier est bien ouvert
        if ($handle) {
            $this->logger->info(self::LOG_INFO_OUVERTURE_FICHIER_REUSSIE);
            $this->stringBuilder_EnteteComposant($handle);
            foreach ($composants as $composant) {
                // Création d'une ligne
                $string_builder = $this->stringBuilder_Composant($composant);
                fwrite($handle, $string_builder);
            }
        } else {
            $this->logger->error(self::LOG_ERREUR_OUVERTURE_FICHIER);
            throw new Exception(self::EXCEPTION_OUVERTURE_FICHIER);
        }
        $this->logger->info(self::LOG_INFO_SUCCESS);
    }

    /**
     * Méthode permetant d'exporter et de mettre en forme un composant en format CSV.
     * @param string $composant Composant à exporter
     * @return string String d'export d'un composant
     */
    private function stringBuilder_Composant($composant) {
        $string_builder = $composant->getSerie() . self::SEPARATEUR .
                $composant->getOf() . self::SEPARATEUR .
                $composant->getCommande() . self::SEPARATEUR .
                $composant->getTypeArticle() . self::SEPARATEUR .
                $composant->getArticle() . self::SEPARATEUR .
                $composant->getDesignation() . self::SEPARATEUR .
                $composant->getGeometrie() . self::SEPARATEUR .
                $composant->getDateBesoin() . self::SEPARATEUR .
                $composant->getQtePrevu() . self::SEPARATEUR .
                $composant->getQteOpt() . self::SEPARATEUR .
                $composant->getQteSaisie() . self::SEPARATEUR .
                $composant->getUnite() . self::SEPARATEUR .
                $composant->getStoseccso() . self::SEPARATEUR .
                $composant->getMethodeappro() . self::SEPARATEUR .
                $composant->getStatut() . self::SEPARATEUR .
                $composant->getQteSaisieTotal() . self::SEPARATEUR .
                self::RETOUR_LIGNE;
        return $string_builder;
    }

    /**
     * Méthode permetant de créer la ligne d'entête du fichier CSV des Composants
     */
    private function stringBuilder_EnteteComposant($handle) {
        $string_builder = 'Serie' . self::SEPARATEUR .
                'OF' . self::SEPARATEUR .
                'Commande' . self::SEPARATEUR .
                'TypeArticle' . self::SEPARATEUR .
                'Article' . self::SEPARATEUR .
                'Designation' . self::SEPARATEUR .
                'Geometrie' . self::SEPARATEUR .
                'DateBesoin' . self::SEPARATEUR .
                'QtePrevu' . self::SEPARATEUR .
                'QteOpt' . self::SEPARATEUR .
                'QteSaisie' . self::SEPARATEUR .
                'Unite' . self::SEPARATEUR .
                'Stoseccso' . self::SEPARATEUR .
                'MethodeAppro' . self::SEPARATEUR .
                'Statut' . self::SEPARATEUR .
                'QteSaisieTotal' . self::SEPARATEUR .
                self::RETOUR_LIGNE;
        fwrite($handle, $string_builder);
    }

    /**
     * Méthode permetant d'exporter et de mettre en forme une file d'attente en format CSV.
     * @param string $file_attente File d'attente à exporter
     * @return string String d'export d'une file d'attente
     */
    private function stringBuilder_FileAttente($file_attente) {
        $string_builder = $file_attente->getSerie() . self::SEPARATEUR .
                $file_attente->getdateFinFabrication() . self::SEPARATEUR .
                $file_attente->getLibelle() . self::SEPARATEUR .
                $file_attente->getDispo() . self::SEPARATEUR .
                $file_attente->getRegroupement() . self::SEPARATEUR .
                $file_attente->getStatut() . self::SEPARATEUR .
                $file_attente->getRessource() . self::SEPARATEUR .
                self::RETOUR_LIGNE;
        return $string_builder;
    }

    /**
     * Méthode permetant de créer la ligne d'entete du fichier CSV des files d'attente
     */
    private function stringBuilder_EnteteFileAttente($handle) {
        $string_builder = 'Serie' . self::SEPARATEUR .
                'DateFinFabrication' . self::SEPARATEUR .
                'Libelle' . self::SEPARATEUR .
                'Dispo' . self::SEPARATEUR .
                'Regroupement' . self::SEPARATEUR .
                'Statut' . self::SEPARATEUR .
                'Ressource' . self::SEPARATEUR .
                self::RETOUR_LIGNE;
        fwrite($handle, $string_builder);
    }
}
