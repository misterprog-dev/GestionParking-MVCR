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
            <span class="titre-plateforme">Affichage détaillé du véhicule</span>    
            <span class="btn-header">
                <a class="btn-secondary" href="index.php">Allez à la liste des vehicules</a>
            </span>    
        </div>
        <hr>
        <fieldset style="width: 499px;margin:auto;text-align: center;">
            <div>
                <img src="./upload/<?php echo $vehicule["photo"]; ?>" width="100" height="100" alt="Image Véhicule">
            </div>
            <div>
                <p>
                    Nom du vehicule :<b><?php echo $vehicule["nom"];?></b> <br> Type: <b><?php echo $vehicule["type"];?></b> <br>
                    Proprietaire <b><?php echo $vehicule["nom_p"];?></b>
                </p>
            </div>   
        </fieldset> 
    </div>
</body>
</html>