<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./src/assets/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <span class="titre-plateforme">Connexion à la Plateforme de gestion de parking Automobile</span>
            <span class="btn-header">
                <a class="btn-primary" href="index.php?controlleur=inscriptionPage">S'inscrire</a>
                <a class="btn-secondary" href="index.php">Allez à la liste des vehicules</a>
            </span>
        </div>
        <hr>
        <div>
            <fieldset style="width: 499px;margin:auto;text-align: center;">
                <div style="margin-bottom: 20px; font-size: 14px;">
                    <?php
                        if (isset($_SESSION['champsObligatoiresLogin'])) {
                            echo '<strong>'.$_SESSION['champsObligatoiresLogin'].'</strong>';
                        }
                        unset($_SESSION['champsObligatoiresLogin']);
                        
                        if (isset($_SESSION['errors_save'])) {
                            echo '<strong>'.$_SESSION['errors_save'].'</strong>';
                        }
                        unset($_SESSION['errors_save']);
                        
                        if (isset($_SESSION['inscriptionSuccess'])) {
                            echo '<strong>'.$_SESSION['inscriptionSuccess'].'</strong>';
                        }
                        unset($_SESSION['inscriptionSuccess']);
                    ?>
                </div>
                <form method="POST" action="index.php?controlleur=login">
                    <div style="margin-bottom: 20px;margin-left: 47px">
                        <label for="mail">Email : </label>
                        <input type="mail" id="email" name="email" placeholder="Email..." value="<?php
                                                                                                    if (isset($_SESSION['user_email'])) {
                                                                                                        echo $_SESSION['user_email'];
                                                                                                    }
                                                                                                    ?>" required />
                    </div>
                    <div style="font-size: 18px;color:red;margin-bottom: 10px;margin-top: -10px;">
                        <?php
                            if (isset($_SESSION['error_email'])) {
                                echo '<small>' . $_SESSION['error_email'] . '</small>';
                            }
                            unset($_SESSION['error_email']);
                        ?>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label for="password">Mot de passe : </label>
                        <input type="password" name="password" id="password" required />
                    </div>
                    <div style="font-size: 18px;color:red;margin-top: 10px;margin-top: -10px;">
                        <?php
                            if (isset($_SESSION['error_password'])) {
                                echo '<small>' . $_SESSION['error_password'] . ' </small>';
                            }
                            unset($_SESSION['error_password']);
                            unset($_SESSION['error_email']);
                            unset($_SESSION['user_email']);
                        ?>
                    </div>
                    <input class="btn-secondary" style="margin-left: 22px;" type="submit" value="Se connecter" />
                </form>
            </fieldset>
        </div>
    </div>
</body>

</html>