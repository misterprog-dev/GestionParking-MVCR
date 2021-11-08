<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/assets/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <span class="titre-plateforme">Plateforme de gestion de parking Automobile</span>
            <?php 
                // Si l'utilisateur est déjà connecté, on va juste lui afficher le bouton de déconnexion. Sinon on lui affiche les bouton connexion et inscription.
                if (isset($_SESSION['user_login'])) { 
            ?>
                <span class="btn-header">
                    <a class="btn-secondary" href="index.php?controlleur=logout">Se déconnecter</a>
                </span>
            <?php } else { ?>
                <span class="btn-header">
                    <a class="btn-primary" href="index.php?controlleur=inscriptionPage">S'inscrire</a>
                    <a class="btn-secondary" href="index.php?controlleur=connexionPage">Se connecter</a>
                </span>
            <?php } ?>            
            <span style="float: right;">
                <?php 
                    if (isset($_SESSION['success_welcome'])) {
                        echo $_SESSION['success_welcome'];
                    }
                    unset($_SESSION['success_welcome']);
                ?>
            </span>
        </div>
        <hr>
        <div style="text-align: center; font-size: 16px;font-weight: bold;">
            <?php

                if(isset($_SESSION["supression"]))
                {
                    echo "  <div>
                                <span>
                                    suppression effectuée
                                </span>
                            </div>";
                    unset($_SESSION["supression"]);
                }

                if(isset($_SESSION["supression_errors"]))
                {
                    echo "  <div>
                                <span>
                                    Echec de la suppression du véhicule.
                                </span>
                            </div>";
                    unset($_SESSION["supression_errors"]);
                }
            ?>
        </div>
       
        <div>
            <h3>Liste des véhicules</h3>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>Plaque</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <?php if (isset($_SESSION['user_login'])) { ?>
                        <th>Actions</th>
                    <?php } ?>
                </tr>
                <?php foreach ($vehicules as $key => $vehicule) {  
                    $ligneDonnees = '<tr>
                                        <td>'.$vehicule['plaque'].'</td>
                                        <td>'.$vehicule['nom'].'</td>
                                        <td>'.$vehicule['type'].'</td>';  
                    
                    if (!isset($_SESSION['user_login'])) {
                        $ligneConditionnee = '</tr>';
                    }

                    if (isset($_SESSION['user_login']) && $_SESSION['user_id'] != $vehicule['id_proprietaire']) {
                        $ligneConditionnee =    '<td>
                                                    <a href="index.php?controlleur=affichageDetailleVehicule&id='.$vehicule['id'].'">Détails</a> 
                                                </td>
                                            </tr>'; 
                    }

                    if (isset($_SESSION['user_login']) && $_SESSION['user_id'] == $vehicule['id_proprietaire']) {
                        $ligneConditionnee =    '<td>
                                                    <a href="index.php?controlleur=affichageDetailleVehicule&id='.$vehicule['id'].'">Détails</a> 
                                                    | <a href="index.php?controlleur=supprimerVehicule&id='.$vehicule['id'].'">Supprimer</a>
                                                </td>
                                            </tr>'; 
                    }            
                    
                    echo $ligneDonnees.''.$ligneConditionnee;
                } ?>                
            </table>
        </div>
        <?php if (isset($_SESSION['user_login'])) { ?>
            <div class="footer">
                <a class="btn-primary" href="index.php?controlleur=ajoutFormulaire">Ajouter un véhicule</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>