<?php

namespace controllers;

use utils\Template;
use routes\base\Route;
use models\ClientsModele;
use controllers\base\WebController;

class ClientController extends WebController
{
    private $ClientModele;

    function __construct()
    {
        $this->ClientModele = new ClientsModele();
    }

    function listeClient($page = 0, $nbLignesParPages = 10): string
    {

        $clients = $this->ClientModele->liste($nbLignesParPages, $page);
        $nbPages = $this->ClientModele->nbPagesTotal($nbLignesParPages);
        return Template::render(
            "views/liste/client.php",
            array("page" => $page, "clients" => $clients, "nbPages" => $nbPages, "nbLignesParPages" => $nbLignesParPages)
        );
    }

    function search($client){
        $clients = $this->ClientModele->recherche($client);
        return Template::render(
            "views/liste/client.php",
            array("clients" => $clients)
        );
    }

}
