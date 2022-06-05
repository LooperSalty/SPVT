<!DOCTYPE html>
<html>
<head>
    <title>VUE-ACHAT</title>

<body>
<head>
    <link href="../styles/multimenu.css" rel="stylesheet">
    <link href="../styles/bootstrap.css" rel="stylesheet"
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">
    <link href="../styles/vue-achat.css" rel="stylesheet">
</head>

<a class="bouton" href="../avis.html"><strong>AVIS</strong></a>
<a class="bouton" href="../Fiche-technique.html"><strong>FICHE TECHNIQUE</strong></a>
<a class="bouton" href="../aide.html"><strong>AIDE</strong></a>
<a class="bouton1" href="index.php"><strong>ACHETER</strong></a>
<div class="portfolio">

    <div class="image active"
         style="background: url(../images/fenetre.jpg) center/cover;">
        <div class="text-container">
            <div class="text">
                <h3>SPVT</h3>
                <p>La premère fenêtre automatique à 100 %</p>
            </div>
        </div>
    </div>

    <div class="image"
         style="background: url(../images/fenetre-mur.png) center/cover;">
        <div class="text-container">
            <div class="text">
                <h3>Design</h3>
                <p>Un design qui s'adape a toutes vos envies !</p>
            </div>
        </div>
    </div>

    <div class="image"
         style="background: url(../images/application-mobile.jpg) center/cover;">
        <div class="text-container">
            <div class="text">
                <h3>Application Mobile</h3>
                <p>Télécommander votre ou vos fenêtre(s) grâce à votre<br> application mobile</p>
            </div>
        </div>
    </div>

    <div class="image"
         style="background: url(../images/bluetooth.png) center/cover;">
        <div class="text-container">
            <div class="text">
                <h3>Bluetooth</h3>
                <p>Bluetooth 5 intégrer</p>
            </div>
        </div>
    </div>

    <div class="image"
         style="background: url(../images/raspberry.png) center/cover;">
        <div class="text-container">
            <div class="text">
                <h3>Raspberry pi 3 b+</h3>
                <p>Un nano ordinateur puissant t polyvalent</p>
            </div>
        </div>
    </div>
</div>


<script src="../jquery/jquery.min.js"
        type="text/javascript"></script>
<script src="../js/bootstrap.js"
        type="text/javascript"></script>
<script src="../js/script.js" type="text/javascript"></script>


<?php
$bddPDO = new PDO('mysql:host=localhost;dbname=fenetre', 'root', ''); // connexion à la base de donnée (fenetre)


?>

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
<input class="boutonafficher" type="button" value="Afficher ou Masquer les stocks disponible"
       onClick="AfficherMasquer()"/>

<!--- Ca c'est le div en question qui possède l'id indiqué dans
la fonction. -->
<div id="divacacher" style="display:none;">
    <table>
        <tr>
            <th colspan="3">NOS STOCK DISPONIBLE</th>
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
            <th colspan="3">STOCK TOTAL DISPONIBLE : <?php echo $total; ?></th>
        </tr>
    </table>
</div>

</body>
</html>