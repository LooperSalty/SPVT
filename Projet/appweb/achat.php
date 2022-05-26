<!DOCTYPE html>
<html>
<head>
    <title>ACHAT</title>
<body>
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
<input type="button" value="Afficher ou Masquer les stocks disponible" onClick="AfficherMasquer()"/>

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
</head>
</html>