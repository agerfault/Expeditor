<?php


namespace AppBundle\DTO;

/**
 * Description of CommandeImport
 *
 * @author d1412mercierc
 */
class CommandeImport {
    
    private $date;
    private $statut;
    private $client;
    
    function __construct($date,  $client,$statut) {
        $this->date = $date;
        $this->statut = $statut;
        $this->client = $client;
    }

    
    
    function getDate() {
        return $this->date;
    }

    function getStatut() {
        return $this->statut;
    }

    function getClient() {
        return $this->client;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }

    function setClient($client) {
        $this->client = $client;
    }


}
