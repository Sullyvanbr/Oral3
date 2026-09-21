<?php
//ROUTEUR

//Autoloader de Composer (lancer "composer install" dans le dossier du projet pour créer ./vendor)
require_once __DIR__ . '/vendor/autoload.php';

use Controller\ControllerExplorer;
use Model\ModelPlace;
use View\ViewExplorer;
use Utils\Utils;

//Récupérer l'url demandé par l'utilisateur
$url = parse_url($_SERVER['REQUEST_URI']);

//Récupérer le path de l'url
$path = isset($url['path']) ? $url['path'] : '/';

//3. Appeler le Controller lié à la route demandée
switch ($path) {
    case '/':
    case $_ENV['explorer']:
        $controller = new ControllerExplorer(new ModelPlace(Utils::connect()), new ViewExplorer("Explorer - Nippon Map", "./public/src/script/explorer.js"));
        $controller->render();
        break;

    default:
        echo "erreur 404";
        break;
}
