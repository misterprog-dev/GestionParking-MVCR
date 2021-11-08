<?php
require_once("views/View.php");

class Controller{
    protected $view; 

    public function __construct(){
        $this->view =new View();
    }

    public function inscriptionPage(){
        $this->view->inscriptionPage();
    }
    
    public function connexionPage()
    {
        $this->view->connexionPage();
    }

}