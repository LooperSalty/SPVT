<?php
session_start(); //démarrage de la session
require_once 'config.php'; // ajout connexion bdd
// si la session existe pas ou fsoit si l'on est pas connecté on redirige vers index.php
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

// On récupere les données de l'utilisateur
$req = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
$req->execute(array($_SESSION['user']));
$data = $req->fetch();

?>

<!doctype html>
<html lang="en">
<head>
    <title>Espace membre</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script crossorigin="anonymous" src="https://kit.fontawesome.com/f0601b0fb2.js"></script>
    <script src='https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js' type='module'></script>
    <script nomodule='' src='https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js'></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet">
    <link href="../../styles/menu-utilisateur.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <div class="col-md-12">
        <?php
        if (isset($_GET['err'])) {
            $err = htmlspecialchars($_GET['err']);
            switch ($err) {
                case 'current_password':
                    echo "<div class='alert alert-danger'>Le mot de passe actuel est incorrect</div>";
                    break;

                case 'success_password':
                    echo "<div class='alert alert-success'>Le mot de passe a bien été modifié ! </div>";
                    break;
            }
        }
        ?>


        <div class="text-center">
            <h1 class="p-5">Bonjour <?php echo $data['pseudo']; ?> !</h1><!--on récupère le pseudo de l'utilisateur-->
            <hr/>
            <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#change_password">
                Changer mon mot de passe
            </button>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Changer mon mot de passe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="layouts/change_password.php" method="POST">
                    <label for='current_password'>Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required/>
                    <br/>
                    <label for='new_password'>Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required/>
                    <br/>
                    <label for='new_password_retype'>Re tapez le nouveau mot de passe</label>
                    <input type="password" id="new_password_retype" name="new_password_retype" class="form-control"
                           required/>
                    <br/>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Changer mon avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="layouts/change_avatar.php" method="POST" enctype="multipart/form-data">
                    <label for="avatar">Images autorisées : png, jpg, jpeg, gif - max 20Mo</label>
                    <input type="file" name="avatar_file">
                    <br/>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </form>
            </div>
            <br/>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!--Interface utilisateur centre de contrôle -->
<!-- Option JavaScript -->
<!-- jQuery premier ensuite Popper.js et enfin Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- partie:index.partie.html -->
<div class="container">
    <div class="components">

        <div class="switch">
            <div class="switch__1">
                <input id="switch-1" type="checkbox">
                <label for="switch-1"></label>
            </div>

            <div class="switch__2">
                <input checked id="switch-2" type="checkbox">
                <label for="switch-2"></label>
            </div>
        </div>

        <div class="checkbox">
            <div class="checkbox__1">
                <input id="checkbox-1" type="checkbox">
                <label for="checkbox-1">
                    <i class="material-icons">done</i></label>
            </div>
            <div class="checkbox__2">
                <input checked id="checkbox-2" type="checkbox">
                <label for="checkbox-2">
                    <i class="material-icons">done</i></label>
            </div>
        </div>

        <div class="radio">
            <div class="radio__1">
                <input id="radio-1" name="radio" type="radio" value="1">
                <label for="radio-1"></label>
            </div>

            <div class="radio__2">
                <input checked id="radio-2" name="radio" type="radio" value="2">
                <label for="radio-2"></label>
            </div>
        </div>

        <div class="btn btn__primary"><p>ouvrir</p></div>
        <div class="btn btn__secondary"><p>fermer</p></div>

        <div class="clock">
            <div class="hand hours"></div>
            <div class="hand minutes"></div>
            <div class="hand seconds"></div>
            <div class="point"></div>
            <div class="marker">
                <span class="marker__1"></span>
                <span class="marker__2"></span>
                <span class="marker__3"></span>
                <span class="marker__4"></span>
            </div>
        </div>

        <div class="chip">
            <div class="chip__icon">
                <ion-icon name="color-palette"></ion-icon>
            </div>
            <p>SPVT</p>
            <div class="chip__close">
                <ion-icon name="close"></ion-icon>
            </div>
        </div>

        <div class="circle">
      <span class="circle__btn">
        <ion-icon class="pause" name="pause"></ion-icon>
        <ion-icon class="play" name="play"></ion-icon>
      </span>
            <span class="circle__back-1"></span>
            <span class="circle__back-2"></span>
        </div>

        <div class="form">
            <input class="form__input" placeholder="Vos ou votre fenêtre(s)..." type="text">
        </div>

        <div class="search">
            <input class="search__input" placeholder="Chercher..." type="text">
            <div class="search__icon">
                <ion-icon name="search"></ion-icon>
            </div>
        </div>

        <div class="segmented-control">

            <input checked id="tab-1" name="radio2" type="radio" value="3"/>
            <label class="segmented-control__1" for="tab-1">
                <p>PRO 1</p></label>

            <input id="tab-2" name="radio2" type="radio" value="4"/>
            <label class="segmented-control__2" for="tab-2">
                <p>PRO 2</p></label>

            <input id="tab-3" name="radio2" type="radio" value="5"/>
            <label class="segmented-control__3" for="tab-3">
                <p>PRO 3</p></label>

            <div class="segmented-control__color"></div>
        </div>

        <div class="icon">
            <div class="icon__home">
                <ion-icon name="home"></ion-icon>
            </div>
            <div class="icon__account">
                <a href="fenetre-utilisateur.php">
                    <ion-icon name="person"></ion-icon>
                </a>
            </div>
            <div class="icon__settings">
                <ion-icon name="settings"></ion-icon>
            </div>
        </div>

        <div class="slider">
            <div class="slider__box">
                <span class="slider__btn" id="find"></span>
                <span class="slider__color"></span>
                <span class="slider__tooltip">50%</span>
            </div>
        </div>
    </div>
</div>

<!-- partie js -->
<script src="../../js/utilisateur.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript"> /* -------------- Ce code permet de changer le background quand t'on clique sur  un lien-------- */

    $(document).ready(function () {

        $("li.one").click(function () {
            $
            ("body").removeClass('bg2 , bg3').addClass("bg1");
        });

        $("li.two").click(function () {
            $
            ("body").removeClass("bg1 , bg3").addClass("bg2");
        });

        $("li.three").click(function () {
            $
            ("body").removeClass("bg1 , bg2").addClass("bg3");
        });

    });

</script>
<style>
    .bg1 {

        background-color: #0c0c0c;
        --primary-light: #000000;
        --primary: #01000c;
        --primary-dark: #04000c;
        --white: #000000;
        --greyLight-1: #383838;
        --greyLight-2: #434444;
        --greyLight-3: #3c3e3f;
        --greyDark: #3b3c41;
    }

    .bg2 {

        background: var(--greyLight-1);
        --primary-light: #8abdff;
        --primary: #6d5dfc;
        --primary-dark: #5b0eeb;
        --white: #FFFFFF;
        --greyLight-1: #ffffff;
        --greyLight-2: #c8d0e7;
        --greyLight-3: #bec8e4;
        --greyDark: #9baacf;
    }

    .bg3 {
        background: var(--greyLight-1);
        --primary-light: #8abdff;
        --primary: #6d5dfc;
        --primary-dark: #5b0eeb;
        --white: #FFFFFF;
        --greyLight-1: #dbe3ec;
        --greyLight-2: #c8d0e7;
        --greyLight-3: #bec8e4;
        --greyDark: #9baacf;
    }

</style>
</body>
</head>
<body>
<ul>
    <li class="one"><a href="#">Mode Sombre</a></li>
    <li class="two"><a href="#">Mode Clair</a></li>
    <li class="three"><a href="#">Mode Normal</a></li>

</ul>
</body>
</html>
