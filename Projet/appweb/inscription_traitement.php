<?php
require_once 'config.php'; // On inclu la connexion à la bdd (fenetre)

// Si les variables existent et qu'elles ne sont pas vides
if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['ville']) && !empty($_POST['telephone']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    // Patch XSS
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $ville = htmlspecialchars($_POST['ville']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);

    // On vérifie si l'utilisateur existe
    $check = $bdd->prepare('SELECT prenom, nom, pseudo, email, ville, telephone, password FROM utilisateurs WHERE email or pseudo  = ?');
    $check->execute(array($email));
    $check->execute(array($pseudo));
    $data = $check->fetch();
    $row = $check->rowCount();

    $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..

    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
    if ($row == 0) {
        if (strlen($prenom) <= 50) {
            if (strlen($nom) <= 50) {
                if (strlen($pseudo) <= 100) { // On verifie que la longueur du pseudo <= 100
                    if (strlen($email) <= 100) { // On verifie que la longueur du mail <= 100
                        if (strlen($ville) <= 100) { //On vérifie que la longueur du nom de la ville <= 100
                            if (strlen($telephone) <= 10) { //On vérifie si le téléphone n'est pas trop long <= 15
                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
                                    if ($password === $password_retype) { // si les deux mdp saisis sont bon
                                        // On hash le mot de passe avec Bcrypt, via un coût de 12
                                        $cost = ['cost' => 12];
                                        $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                                        // On stock l'adresse IP
                                        $ip = $_SERVER['REMOTE_ADDR'];
                                        /*
                                        ATTENTION
                                        le champs token doit bien être présent dans la table utilisateurs, il a été rajouté dans les
                                        dernière version de php/sql pour avoir plus de sécurité
                                        le .sql est obselète j'utilise ici du PDO et du query ce qui est pour moi le mieux
                                        mais il existe aussi la bibliothèque mysqli qui est aussi d'actualité.
                                        ATTENTION
                                        */
                                        // On insère dans la base de données
                                        $insert = $bdd->prepare('INSERT INTO utilisateurs(prenom, nom, pseudo, email, ville, telephone, password, ip, token) VALUES(:prenom, :nom, :pseudo, :email, :ville, :telephone, :password, :ip, :token)');
                                        $insert->execute(array(
                                            'prenom' => $prenom,
                                            'nom' => $nom,
                                            'pseudo' => $pseudo,
                                            'email' => $email,
                                            'ville' => $ville,
                                            'telephone' => $telephone,
                                            'password' => $password,
                                            'ip' => $ip,
                                            'token' => bin2hex(openssl_random_pseudo_bytes(64))
                                        ));
                                        // On redirige avec le message de succès
                                        header('Location:inscription.php?reg_err=success');
                                        die();
                                    } else {
                                        header('Location: inscription.php?reg_err=password');
                                        die();
                                    }
                                } else {
                                    header('Location: inscription.php?reg_err=email_lenght');
                                    die();
                                }
                            } else {
                                header('Location: inscription.php?reg_err=telephone_lenght');
                                die();
                            }
                        } else {
                            header('Location: inscription.php?reg_err=ville_length');
                            die();
                        }
                    } else {
                        header('Location: inscription.php?reg_err=email');
                        die();
                    }
                } else {
                    header('Location: inscription.php?reg_err=pseudo_lenght');
                    die();
                }
            } else {
                header('Location: inscription.php?reg_err=nom_lenght');
                die();
            }
        } else {
            header('Location: inscription.php?reg_err=prenom_lenght');
        }
    } else {
        header('Location: inscription.php?reg_err=already');
        die();
    }
}

