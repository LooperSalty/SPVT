<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Looper_Salty"/>
    <title>Connexion</title>
    <!-- bootstrap -->
    <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Connexion</title>
</head>
<body>

<div class="login-form">
    <?php
    if (isset($_GET['login_err'])) {
        $err = htmlspecialchars($_GET['login_err']);

        switch ($err) {
            case 'password':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> mot de passe incorrect
                </div>
                <?php
                break;

            case 'email':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> email incorrect
                </div>
                <?php
                break;

            case 'already':
                ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> compte non existant
                </div>
                <?php
                break;
        }
    }
    ?>

    <form action="connexion.php" method="post">
        <h2 class="text-center">Connexion</h2>
        <!-- champ email -->
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="required"
                   autocomplete="off">
        </div>
        <!-- champ mdp -->
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe"
                   required="required" autocomplete="off">
        </div>
        <!-- bouton connexion -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
        </div>

    </form>
    <p class="text-center"><a href="inscription.php">Inscription</a></p> <!-- bouton inscription -->
    <p class="text-center"><a href="menu-mdp.php">Mot de passe oublier ?</a></p> <!-- bouton mot de passe oublier -->
    <p class="text-center"><a href="../aide.html">Email oublier ?</a></p> <!-- bouton email oublier l'utilisateur doit contacter le service aide pour récuperer son email
     ou si il n'as plus accès à son email du à une fermeture de boite mail -->
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
