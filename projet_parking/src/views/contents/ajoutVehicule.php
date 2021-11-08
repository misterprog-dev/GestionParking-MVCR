<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking | Ajout véhicule</title>
    <link rel="stylesheet" href="./src/assets/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <span class="titre-plateforme">Ajouter un véhicule</span>
            <span class="btn-header">
                <a class="btn-secondary" href="index.php">Allez à la liste des vehicules</a>
            </span>
        </div>
        <hr>
        <div>
            <fieldset style="width: 499px;margin:auto;text-align: center;">
                <div style="margin-bottom: 20px; font-size: 14px;">
                    <?php
                        if (isset($_SESSION['champsObligatoiresAjoutVehicule'])) {
                            echo '<strong>'.$_SESSION['champsObligatoiresAjoutVehicule'].'</strong>';
                        }
                        unset($_SESSION['champsObligatoiresAjoutVehicule']);

                        if (isset($_SESSION['vehiculeExistant'])) {
                            echo '<strong>'.$_SESSION['vehiculeExistant'].'</strong>';
                        }
                        unset($_SESSION['vehiculeExistant']);
                        
                        if (isset($_SESSION['error'])) {
                            echo '<strong>'.$_SESSION['error'].'</strong>';
                        }
                        unset($_SESSION['error']);
                        
                        if (isset($_SESSION['ajoutVehiculeSuccess'])) {
                            echo '<strong>'.$_SESSION['ajoutVehiculeSuccess'].'</strong>';
                        }
                        unset($_SESSION['ajoutVehiculeSuccess']);
                    ?>
                </div>
                <form method="POST" action="index.php?controlleur=ajoutVehicule" enctype="multipart/form-data">
                    <div style="margin-bottom: 20px;margin-left: -16px">
                        <label for="plaque">Plaque (*): </label>
                        <input type="text" id="plaque" name="plaque" required />
                    </div>                   
                    <div style="margin-bottom: 20px;">
                        <label for="nom">Nom (*): </label>
                        <input type="text" name="nom" id="nom" required/>
                    </div>   
                    <div style="margin-bottom: 20px;">
                        <label for="type">Type (*): </label>
                        <input type="text" name="type" id="type" required/>
                    </div>
                    <div style="margin-bottom: 20px;margin-left: 70px;">
                        <label for="photo">Photo (*): </label>
                        <input type="file" name="photo" id="photo" accept=".png, .jpg, .jpeg" required/>
                    </div>  
                    <div>
                        <input type="hidden" name="idProprietaire" value="<?php
                                                                                if (isset($_SESSION['user_id'])) {
                                                                                    echo $_SESSION['user_id'];
                                                                                }
                                                                                ?>"/>
                    </div>                
                    <input class="btn-primary" style="margin-left: 22px;" type="submit" value="Enregistrer" />
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
