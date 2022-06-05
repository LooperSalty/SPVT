<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Looper_Salty"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Inscription</title>
</head>
<body>
<div class="login-form">
    <?php
    if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);

        switch ($err) {
            case 'success':
                ?>
                <div class="alert alert-success">
                    <strong>Succès</strong> inscription réussie !
                </div>
                <?php
                break;

            case 'password':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> mot de passe différent
                </div>

                <?php
                break;

            case 'telephone':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> telephone non valide
                </div>

                <?php
                break;

            case 'ville_lenght':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> nom de ville non valide
                </div>

                <?php
                break;

            case 'email_lenght':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email non valide
                </div>
                <?php
                break;

            case 'email_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email trop long
                </div>
                <?php
                break;

            case 'pseudo_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> pseudo trop long
                </div>
                <?php
                break;

            case 'nom_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> nom de famille trop long
                </div>
                <?php
                break;

            case 'prenom_length':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> prenom trop long
                </div>
            <?php
            case 'already':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> compte deja existant
                </div>
            <?php

        }
    }
    ?>

    <form action="inscription_traitement.php" method="post">
        <h2 class="text-center">Inscription</h2>
        <div class="form-group">
            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <input type="text" name="ville" class="form-control" placeholder="Ville" required="required"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <input type="tel" name="telephone" class="form-control" placeholder="Téléphone" required="required"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required"
                   autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe"
                   required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Inscription</button>
        </div>
    </form>

    <div class="form-group">
        <a href="generateur-mdp.html">
            <button type="submit" class="btn btn-primary btn-block ">générateur de mot de passe
            </button>
        </a>
    </div>
</div>

<style>
    .login-form {
        width: 340px;
        margin: 50px auto;
    }

    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .login-form h2 {
        margin: 0 0 15px;
    }

    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }

    .btn {
        font-size: 15px;
        font-weight: bold;
    }

</style>
</body>
</html>