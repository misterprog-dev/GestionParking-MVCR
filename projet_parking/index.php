<?php

set_include_path("./src");

require_once("Router.php");

$router = new Router();

$route = isset($_GET['controlleur']) ? $_GET['controlleur'] : '';

switch ($route) {
    case 'affichageDetailleVehicule':
        $router->affichageDetailleVehicule();        
        break;
    case 'inscriptionPage':
        $router->inscriptionPage();        
        break;
    case 'connexionPage':
        $router->connexionPage();        
        break;
    case 'supprimerVehicule':
        $router->supprimerVehicule();    
        break;
    case 'ajoutFormulaire':
        $router->ajoutFormulaire();        
        break;
    case 'inscription':
        $router->inscription();        
        break;
    case 'login':
        $router->connexion();    
        break;
    case 'logout':
        $router->deconnexion();        
        break;
    case 'ajoutVehicule':
        $router->ajoutVehicule();        
        break;
    default:
        $router->exec();
        break;
}
