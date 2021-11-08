<?php
require_once "./src/config/Database.php";
require_once "./src/models/ProprietaireDB.php";
require_once "./src/models/VehiculeDB.php";
require_once  "./src/models/Proprietaire.php";
require_once "./src/views/View.php";

class ProprietaireController
{
    private $db;
    private $connection;
    private $view;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->connect();
        $this->view = new View();
    }

    /**
     * fonction qui determine l'action a executer
     *
     */
    public function action($action)
    {
        switch ($action) {
            case "creer":
                $this->creer();
                break;
            case "login":
                $this->login();
                break;
            case "logout":
                $this->logout();
                break;
                /* 
            case "miseAjour" :
                $this->miseAjour();
                break;
            default:
                $this->index();
                break; */
        }
    }

    public function creer()
    {
        $nom        = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom     = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $email      = $_POST['email'];
        $tel        = $_POST['tel'];
        $password   = $_POST['password'];
        if (isset($email) && isset($password)) {
            try {
                $proprietaire = new Proprietaire($nom, $prenom, $email, $tel, $password);
                $proprietaireDB = new ProprietaireDB($this->connection, $proprietaire);

                // On vérifie s'il existe un proprietaire avec cet email.
                $proprietaireExistant = $proprietaireDB->getByColumn('email', $email);               

                if (sizeof($proprietaireExistant) >= 1) {
                    $_SESSION['email_exists'] = 'Cet email existe déjà, veuillez choisir un autre !';
                    $this->view->inscriptionPage();
                } 
                else {
                    $proprietaireDB->save();

                    $_SESSION['user_email'] = $email;

                    // Une fois l'inscription effectuée, on va à la page de connexion.
                    $this->view->connexionPage();
                }

                // On se déconnecte de la BD
                $this->db->disconnect();
            } catch (Exception $ex) {
                $_SESSION['error_enregistrement'] = 'Une erreur est survenue pendant l\'enregistrement, veuillez contacter le support !';
            }
        } // Les champs obligatoires n'ont pas été renseigné.
        else {
            $_SESSION['champsObligatoiresInscription'] = 'Les champs (*) sont obligatoires !';
        }
    }

    public function login()
    {
        $email          = $_POST['email'];
        $password       = $_POST['password'];

        if (isset($email) && isset($password)) {
            try {
                //On vérifie si le proprietaire existe bien en BD
                $proprietaireDB = new ProprietaireDB($this->connection, null);
                $proprietaire = $proprietaireDB->getByColumn('email', $email);

                // Si l'email existe, alors on continue les opérations de vérification.
                if (sizeof($proprietaire) >= 1) {

                    // On vérifie le mot de passe
                    if (password_verify($password, $proprietaire[0]['password'])) {
                        $_SESSION['success_welcome'] = 'Bienvenue M/Mme/Mlle ' . $proprietaire[0]['nom'] . ' ' . $proprietaire[0]['prenom'];
                        $_SESSION['user_login'] = $email;
                        $_SESSION['user_id'] = $proprietaire[0]['id'];

                        // On va à la page d'accueil et on charge tous les véhicules
                        $vehiculeDB = new VehiculeDB($this->connection, null);
                        $vehicules = $vehiculeDB->getAll();
                        $this->view->HomePage($vehicules);
                    } // Si le mot de passe n'existe pas 
                    else {
                        $_SESSION['user_email'] = $email;
                        $_SESSION['error_password'] = 'Mot de passe incorrecte !';
                        $this->view->connexionPage();
                    }
                } else {
                    $_SESSION['error_email'] = 'Cet adresse email n\'existe pas !';
                    $this->view->connexionPage();
                }
            } catch (Exception $e) {
                $_SESSION['errors_save'] = 'Impossible d\'accéder aux données, veuillez contacter le support !';
                $this->view->connexionPage();
            }
        } else {
            $_SESSION['champsObligatoiresLogin'] = 'Remplissez tous les champs svp !';
            $this->view->connexionPage();
        }
    }

    public function logout()
    {
        // On détruit nos sessions
        session_destroy();

        // On va à la page d'accueil et on charge tous les véhicules.
        header('location:index.php');
    }

    public function formulaireAjoutVehicule()
    {
        $this->view->formulaireAjoutVehicule();
    }
}
