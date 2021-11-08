<?php
class View
{
    //private Router $router;

    public function __construct()
    {
        //$this->router = $router;
    }

    public function HomePage($vehicules)
    {
        include_once("contents/Home.php");
    }

    public function DetaillePage($vehicule)
    {
        include_once("contents/AffichageDetaille.php");
    }

    public function inscriptionPage()
    {
        include_once("contents/inscription.php");
    }

    public function connexionPage()
    {
        include_once("contents/Connexion.php");
    }
    public function formulaireAjoutVehicule()
    {
        include_once ("contents/ajoutVehicule.php");
    }
}
