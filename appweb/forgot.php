<?php
require_once 'config.php';

if (!empty($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    $bdd = new PDO("mysql:host=localhost;dbname=fenetre;charset=utf8", "root", "");
    $check = $bdd->prepare('SELECT token FROM utilisateurs WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row) {
        $token = bin2hex(openssl_random_pseudo_bytes(24));
        $token_user = $data['token'];
        $bdd = new PDO("mysql:host=localhost;dbname=fenetre;charset=utf8", "root", "");
        $insert = $bdd->prepare('INSERT INTO password_recover(token_user, token) VALUES(?,?)');
        $insert->execute(array($token_user, $token));
        $link = 'recover.php?u=' . base64_encode($token_user) . '&token=' . base64_encode($token);
        $message = "localhost:63342/inscription.php/appweb/password_change.php?$link";
        $check = $bdd->prepare('SELECT email FROM utilisateurs');
        $check->execute(array($email));
        $to = $email;
        mail($to, 'Rénisialiser votre mot de passe', $message); // il faut configurer send mail et php.ini pour envoyer des mail avec php et aussi mettre le bon port selon le type de boite mail utiliser.
        ?>
        <head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        <body>
        <div class="container">
            <div class="col-11">
                <div class="card text-center m-4 shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h4 class="card-title p-3">Un email vous avez était envoyer pour rénisialiser votre mot de
                            passe</h4>
                        <div class="form-group">
                            <form action="forgot.php" method="POST">
                                <input type="email" class="form-control" name="email" placeholder="Renvoyer un email"
                                       autocomplete="off"
                                       required/>
                                <button type="submit" class="btn btn-primary btn-lg m-3">Renvoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </head>
        <?php
    } else {
        echo "Compte non existant";
        //header('Location: menu-mdp.php');
        //die();
    }
}
//spvt/appweb/menu-mdp.php

