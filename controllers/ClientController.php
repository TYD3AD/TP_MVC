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

    function search($client)
    {
        $clients = $this->ClientModele->recherche($client);
        return Template::render(
            "views/liste/client.php",
            array("clients" => $clients)
        );
    }

    function client($id)
    {
        $infos = $this->ClientModele->infos($id);
        $produits = $this->ClientModele->produits($id);
        $adresses = $this->ClientModele->adresses($id);
        return Template::render(
            "views/fiche/client.php",
            array("infos" => $infos, "produits" => $produits, "adresses" => $adresses)
        );
    }

    function supprimerAdresse($id)
    {
        $this->ClientModele->supprimerAdresse($id);
        $infos = $this->ClientModele->infos($id);
        $produits = $this->ClientModele->produits($id);
        $adresses = $this->ClientModele->adresses($id);
        // redirection vers la fiche client
        return $this->redirect("/client/$id");    }

    function commander($id)
    {
        if(!isset($_POST['Nom']) || !isset($_POST['description']) || !isset($_POST['prix'])){
            return Template::render(
                "views/fiche/commander.php",
                array("id" => $id)
            );
        }
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $nom = htmlspecialchars($_POST['Nom']);
        $envoi = $this->ClientModele->commander($id, $nom, $description, $prix);
        if($envoi != true){
            return Template::render(
                "views/fiche/commander.php",
                array("id" => $id, "envoi" => $envoi)
            );
        }
        $infos = $this->ClientModele->infos($id);
        $produits = $this->ClientModele->produits($id);
        $adresses = $this->ClientModele->adresses($id);
        return Template::render(
            "views/fiche/client.php",
            array("infos" => $infos, "produits" => $produits, "adresses" => $adresses)
        );
    }

    function adresse($id)
    {
        if(!isset($_POST['nom']) || !isset($_POST['rue']) || !isset($_POST['codePostal']) || !isset($_POST['ville'])){
            return Template::render(
                "views/fiche/adresse.php",
                array("id" => $id)
            );
        }
        $nom = htmlspecialchars($_POST['nom']);
        $rue = htmlspecialchars($_POST['rue']);
        $codePostal = htmlspecialchars($_POST['codePostal']);
        $ville = htmlspecialchars($_POST['ville']);
        $envoi = $this->ClientModele->adresse($id, $nom, $rue, $codePostal, $ville);
        if($envoi != true){
            return Template::render(
                "views/fiche/adresse.php",
                array("id" => $id, "envoi" => $envoi)
            );
        }
        $infos = $this->ClientModele->infos($id);
        $produits = $this->ClientModele->produits($id);
        $adresses = $this->ClientModele->adresses($id);
        return Template::render(
            "views/fiche/client.php",
            array("infos" => $infos, "produits" => $produits, "adresses" => $adresses)
        );
    }
}
