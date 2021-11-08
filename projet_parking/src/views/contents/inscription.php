<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking | Inscription</title>
    <link rel="stylesheet" href="./src/assets/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <span class="titre-plateforme">Bienvenue sur la page d'inscription de notre parking</span>
            <span class="btn-header">
                <a class="btn-secondary" href="index.php?controlleur=connexionPage">Se connecter</a>
                <a class="btn-primary" href="index.php">Allez à la liste des vehicules</a>
            </span>
        </div>
        <hr>
        <div>
            <p><i>Complétez le formulaire. Les champs marqué par </i><em>*</em> sont <em>obligatoires</em></p>
            <fieldset style="width: 499px;margin:auto;text-align: center;">
                <div style="margin-bottom: 20px; font-size: 14px;">
                    <?php
                        if (isset($_SESSION['champsObligatoiresInscription'])) {
                            echo '<strong>'.$_SESSION['champsObligatoiresInscription'].'</strong>';
                        }
                        unset($_SESSION['champsObligatoiresInscription']);
                        
                        if (isset($_SESSION['error_enregistrement'])) {
                            echo '<strong>'.$_SESSION['error_enregistrement'].'</strong>';
                        }
                        unset($_SESSION['error_enregistrement']);
                        
                        if (isset($_SESSION['email_exists'])) {
                            echo '<strong>'.$_SESSION['email_exists'].'</strong>';
                        }
                        unset($_SESSION['email_exists']);
                    ?>
                </div>
                <form action="index.php?controlleur=inscription" method="post">
                    <div>
                        <div class="header">
                            <div>
                                <div style="margin-bottom: 10px;margin-left: 39px">
                                    <label for="nom">nom</label> : 
                                    <input type="text" name="nom" id="nom" />
                                </div>
                                <div style="margin-bottom: 10px;margin-left: 19px">
                                    <label for="prenom">prenom</label> : 
                                    <input type="text" name="prenom" id="prenom" />
                                </div>
                                <div style="margin-bottom: 10px;margin-left: 19px">
                                    <label for="email">Email <em>*</em></label> :
                                    <input type="email" name="email" id="email" required />
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label for="tel">telephone<em>*</em></label> : 
                                    <input type="tel" name="tel" id="tel" required />
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label for="password">Password<em>*</em></label> : 
                                    <input type="password" name="password" id="password" />
                                </div>                                
                                <input class="btn-primary" type="submit" value="Valider" />
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</body>
</html>
