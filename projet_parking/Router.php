<?php
require_once("views/View.php");
require_once("controllers/VehiculeController.php");
require_once("controllers/ProprietaireController.php");
require_once("controllers/Controller.php");

class Router{
    private $vehiculeControlleur;
    private $proprietaireControlleur;
    private $controlleur;

    public function __construct()
    {
        $this->vehiculeControlleur = new VehiculeController();
        $this->proprietaireControlleur = new ProprietaireController();
        $this->controlleur= new Controller();
    }

    public function exec()
    {
        $this->vehiculeControlleur->action('index');
    }

    public function affichageDetailleVehicule()
    {
        $this->vehiculeControlleur->action('affichage');
    }

    public function supprimerVehicule()
    {
        $this->vehiculeControlleur->action('supprimer');
    }

    public function inscriptionPage()
    {
        $this->controlleur->inscriptionPage();
    }

    public function connexionPage()
    {
        $this->controlleur->connexionPage();
    }

    public function ajoutFormulaire()
    {
        $this->vehiculeControlleur->action("ajoutformulaire");
    }

    public function ajoutVehicule()
    {
        $this->vehiculeControlleur->action("creer");
    }

    public function inscription()
    {
        $this->proprietaireControlleur->action("creer");
    }

    public function connexion()
    {
        $this->proprietaireControlleur->action("login");
    }

    public function deconnexion()
    {
        $this->proprietaireControlleur->action("logout");
    }
}