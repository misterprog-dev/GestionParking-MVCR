<?php
session_start();
require_once "./src/config/Database.php";
require_once "./src/models/VehiculeDB.php";
require_once  "./src/models/Vehicule.php";
require_once "./src/views/View.php";

class VehiculeController{
    private $db;
    private $connection;
    private $view;

    public function __construct() {
        $this->db = new Database();
        $this->connection = $this->db->connect();
        $this->view = new View();
    }

        /**
        * fonction qui determine l'action a executer
        *
        */
    public function action($action){
        switch($action)
        {
            case "index" :
                $this->index();
                break;
            case "affichage" :
                $this->affichage();
                break;
            case "supprimer":
                $this->supprimer();
                break;
            case "ajoutformulaire":
                $this->formulaireAjoutVehicule();
                break;
            case "creer" :
                $this->creer();
                break;
            
            /* case "miseAjour" :
                $this->miseAjour();
                break;
            default:
                $this->index();
                break; */
        }
    }

    /**
    *
    *charge toute les vehicule du model
    *
    *
    */
    public function index(){
        $vehiculeDB = new VehiculeDB($this->connection, null);
        $vehicules = $vehiculeDB->getAll();
        $this->view->HomePage($vehicules);
    }

    public function affichage(){
        if (isset($_GET["id"]) && $_GET["id"]!=null)
         { $infos = (int) strip_tags($_GET["id"]);
            $vehiculeDB = new VehiculeDB($this->connection, null);
            $vehicule = $vehiculeDB->rechercheDetaillee($infos);
            $vehicule = json_decode(json_encode($vehicule), True);
            $this->view->DetaillePage($vehicule);
        }
    }

    public function supprimer(){
        if (isset($_GET['id']))
         {
            $vehiculeDB = new VehiculeDB($this->connection, null);
            if ($vehiculeDB->deleteById($_GET['id']) != -1) {
                $_SESSION["supression"]=true;
                $this->index();
            }else{
             
                $_SESSION["supression_errors"]=true;
            }
        }
    }
    
    public function formulaireAjoutVehicule()
    {
        $this->view->formulaireAjoutVehicule();
    }

    public function creer(){
        $plaque         = $_POST['plaque'];
        $nom            = $_POST['nom'];
        $type           = $_POST['type'];
        $idProprietaire = $_POST['idProprietaire'];
        $photo          = $_FILES['photo'];

        if (isset($plaque) && isset($nom) && isset($type) && isset($idProprietaire) && isset($photo))
        {

            // On traite l'image ici avant d'enregistrer l'info dans la BD
            $file_size =$photo['size'];
            $file_tmp =$photo['tmp_name'];
            $infosFichier = pathinfo($photo['name']);
            $file_ext = $infosFichier['extension'];

            // Si notre photo est très lourde depassant 10MB on affiche une erreur.
            if($file_size > 10097152){
                $_SESSION['error'] = 'Votre photo ne doit pas dépasser 10 MB';
            }
            else {
                try {
                    
                    $vehicule = new Vehicule($plaque, $nom, $type, $plaque.".".$file_ext);
                    $vehiculeDB = new VehiculeDB($this->connection, $vehicule);
    
                    // On vérifie si cette plaque existe déjà, on a une unicité des plaques.
                    $vehiculePlaqueExistante = $vehiculeDB->getByColumn('plaque', $plaque);
    
                    if (sizeof($vehiculePlaqueExistante) >= 1) {
                        $_SESSION['vehiculeExistant'] = 'Cette plaque existe déjà, veuillez renseigner une autre !';
                    }
                    else {

                        // On essaie d'enregistrer notre photo si tout se passe bien, on continue l'opération sinon on affiche une erreur.
                        if (move_uploaded_file($file_tmp, "./upload/".$plaque.".".$file_ext)) {
                            $vehiculeDB->save($idProprietaire);
                            $_SESSION['ajoutVehiculeSuccess'] = 'Vehicule ajouté avec succès !';
                        } 
                        else {
                            $_SESSION['error'] = 'Impossible de télécharger la photo, contacter le support svp !';
                        }                         
                    }
                
                } catch (Exception $ex) {
                    $_SESSION['error'] = 'Une erreur est survenue, veuillez contacter le support !'; 
                }                               
            }
        }
        else {
            $_SESSION['champsObligatoiresAjoutVehicule'] = 'Remplissez tous les champs svp !';
        }

        $this->view->formulaireAjoutVehicule(); 
    }
}
