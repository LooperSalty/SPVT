<?php
session_start(); //démarrage de la session
require_once 'config.php'; // ajout connexion bdd
// si la session existe pas soit si l'on est pas connecté on redirige vers index.php
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
    <title>fenetre-utilisateur</title>
    <!-- meta -->
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


        <div class="text-center">
            <h1 class="p-5">Bonjour <?php echo $data['pseudo']; ?> !</h1>
            <hr/>
            <a href="deconnexion.php" class="btn btn-danger btn-lg">Déconnexion</a>
            <!-- Button trigger modal -->

        </div>


    </div>
</div>
<!--- On récupère les info de l'utilistateur en lui écrivant sur la page pour lui montrer ses infos si c'est infos
ne sont pas les bonnes il peut nous contacter pour pouvoir les changer cela permet de
réduire les risques de bug ou d'augmenter l'efficacité des problème du au site web ou à la base de données--->
<div class="text-center">
    <h1>Vos informations</h1>
    <h2 class="p-6"> votre prénom: <?php echo $data['prenom']; ?> !</h2>
    <h3 class="p-6"> votre nom:<?php echo $data['nom']; ?> !</h3>
    <h4 class="p-6"> votre email:<?php echo $data['email']; ?> !</h4>
    <h5 class="p-6"> votre téléphone:<?php echo $data['telephone']; ?> !</h5>
    <h6 class="p-6"> votre ville:<?php echo $data['ville']; ?> !</h6>

</div>
<br><br>
<?php
$bddPDO = new PDO('mysql:host=localhost;dbname=fenetre', 'root', ''); // connexion à la base de donnée (fenetre)
$id = $data['id'];// on récupère l'id de l'utilisateurs
$req = "SELECT  id_fenetre, couleur, fermer, ouvert, alerte\n" // on sélectionne les données à transmettre sur les infos de la fenêtre

    . "FROM fenetre_utilisateurs\n"  // les données sont sélectionner depuis la table fenetre_utlisateurs

    . "LEFT JOIN utilisateurs\n" // jointure avec la table d'utilisateurs

    . "ON fenetre_utilisateurs.id = utilisateurs.id\n" // lien entre les deux id des deux tables choisit

    . "WHERE fenetre_utilisateurs.id_fenetre = $id;";  // condition sql avec la avriable php pour définir l'id de l'utilisateurs choisit par rapport à celui de l'id de la fenêtre
$result = $bddPDO->query($req);
if (!$result) {
    echo "La récupération des données à rencontrée un problème! ou vous n'avez pas de fenêtre(s) ";
} else {
    $nbre_fenetre = $result->rowCount();
    ?>
    <div class="align-content-center">
        <h1>Vos fenêtre</h1>
        <h2>Vous avez <?= $nbre_fenetre ?> fenêtre à votre disposition</h2>
        <!-- tableau des données récuperer lors de la jointure -->
        <table border="1">
            <tr>
                <th>id_fenêtre</th>
                <th>couleur</th>
                <th>ouverture</th>
                <th>fermeture</th>
                <th>alerte</th>
            </tr>
            <?php

            while ($ligne = $result->fetch(PDO::FETCH_NUM)) { //on fais un résultat du nombre de ligne pour savoir combien l'uilisateurs dispose de fenêtre
                echo "<tr>";
                foreach ($ligne as $valeur) {
                    echo "<td>$valeur</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <?php
    $result->closeCursor();

}
//$sql = 'SELECT id_fenetre, couleur, fermer, ouvert, alerte"
//. " FROM fenetre_utilisateurs"
//. " LEFT JOIN utilisateurs"
//. " ON fenetre_utilisateurs.id = utilisateurs.id"
//. " WHERE fenetre_utilisateurs.id_fenetre = :id;';
//$sth = $dbh->prepare($sql);
// Deux solutions:
// 1:
//$sth->bind_param(':id', $id); // Fait le lien entre :id de ta requête avec $id de ton programme
//$sth->execute();
// 2:
//$sth->execute(array('id' => $id));

//$result = $sth->fetchAll();
// $result contient un tableau du type:
// $result["id_fenetre"] = $idDeTaFenetre
// $result["couleur"] = $couleurDeTaFenetre
// Tu peux utiliser l'index:
// $result[0] sera égal à $result["id_fenetre"] car c'est la première colonne demandée par ton SELECT de ta requête
?>


<style>
    body {
        left: auto;
    }

    .align-content-center {
        border-collapse: collapse;
        min-width: 400px;
        width: auto;
        box-shadow: 0 5px 50px rgba();
        cursor pointer;
        border: 2px solid midnightblue;
    }

    table tr {
        background-color: #a5acb4;
        color: #0c0c0c;
        text-align: left;
    }

    th, tr {
        padding 15px 20px;
        background-color: #d5dae0;
    }
</style>
<!-- ancien bouton voir /masquer
<div id="a_masquer">

</div>

<input type="button" value="Masquer" onclick="masquer_div('a_masquer');"/>
<script>
    function masquer_div(id) {
        if (document.getElementById(id).style.display == 'none') {
            document.getElementById(id).style.display = 'block';
        } else {
            document.getElementById(id).style.display = 'none';
        }
    }
</script>
-->
<script type="text/javascript">
    <!-- Voici la fonction javascript qui change la propriété "display" pour afficher ou non le div selon que ce soit "none" ou "block"  -->
    function
    AfficherMasquer() {
        divInfo = document.getElementById('divacacher');

        if (divInfo.style.display == 'none')
            divInfo.style.display = 'block';
        else
            divInfo.style.display = 'none';

    }
</script>

<!--La c'est le bouton qui va afficher le div en cliquant dessus. --->
<input type="button" value="Afficher ou Masquer" onClick="AfficherMasquer()"/>

<!--- Ca c'est le div en question qui possède l'id indiqué dans
la fonction. -->
<div id="divacacher" style="display:none;">
    <table>
        <tr>
            <th colspan="3">NOS STOCK DISPONIBLE</th>
            <!-- tableau des stock disponible depuis la table de donnée "stock" -->
        </tr>
        <tr>
            <th>couleur</th>
            <th>stock</th>
        </tr>
        <?php

        $req = 'SELECT * FROM stock';  //on sélectionne la table "stock" pour savoir combien il nous reste de stock disponible par fenêtre
        $result = $bddPDO->query($req);
        $total = 0;
        while ($affichage = $result->fetch(PDO::FETCH_ASSOC)) {
            echo
                '<tr>        
		<td>' . $affichage['couleur'] . '</td> <!--affichage des couleur par ligne-->
		<td>' . $affichage['stock'] . '</td>  <!--affichage du stock par ligne -->
	</tr>
';
            $total += $affichage['stock']; //on fait le total
        }
        ?>
        <tr>
            <th colspan="3">STOCK TOTAL DISPONIBLE : <?php echo $total; ?></th> <!-- on affiche le total -->
        </tr>
    </table>
</div>


</body>
</html>
</html>