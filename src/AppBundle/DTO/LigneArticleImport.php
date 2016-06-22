<?php


namespace AppBundle\DTO;

/**
 * Description of LigneArticleImport
 *
 * @author d1412mercierc
 */
class LigneArticleImport {
    
    
    private $quantite;
    private $article;
    private $date;
    private $client;
    
    
    function __construct($quantite, $article, $date, $client) {
        $this->quantite = $quantite;
        $this->article = $article;
        $this->date = $date;
        $this->client = $client;
    }

    
    function getQuantite() {
        return $this->quantite;
    }

    function getArticle() {
        return $this->article;
    }

    function getDate() {
        return $this->date;
    }

    function getClient() {
        return $this->client;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setArticle($article) {
        $this->article = $article;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setClient($client) {
        $this->client = $client;
    }


    
    
    
}
