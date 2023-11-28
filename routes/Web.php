<?php

namespace routes;

use utils\Template;
use routes\base\Route;
use utils\SessionHelpers;
use controllers\ClientController;
use controllers\SampleWebController;

class Web
{
    function __construct()
    {
        $main = new SampleWebController();
        $client = new ClientController();

        // Appel la méthode « home » dans le contrôleur $main.
        /*         Route::Add('/', [$main, 'home']);*/
        Route::Add('/exemple', [$main, 'exemple']);
        Route::Add('/exemple2/{parametre}', [$main, 'exemple']);
        Route::Add('/', [$client, 'listeClient']);
        Route::Add('/search', [$client, 'search']);
        Route::Add('/liste', [$client, 'listeClient']);


        // Appel la fonction inline dans le routeur.
        // Utile pour du code très simple, où un test, l'utilisation d'un contrôleur est préférable.
        Route::Add('/about', function () {
            return Template::render('views/global/about.php');
        });
        Route::Add('/client/{id}', [$client, 'client']);
        Route::Add('/supprimer', [$client, 'supprimerAdresse']);
        Route::Add('/commander', [$client, 'commander']);
        Route::Add('/adresse', [$client, 'adresse']);

    }
}
