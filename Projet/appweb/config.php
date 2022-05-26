<?php
/*
   Attention ! le host => l'adresse de la base de données et non du site !!

   Pour les exemple avec un port à spécifier ex :
   $bdd = new PDO("mysql:host=CHANGER_HOST_ICI;dbname=CHANGER_DB_NAME;charset=utf8;port=3306", "CHANGER_LOGIN", "CHANGER_PASS");

 */
try {
    $bdd = new PDO("mysql:host=localhost;dbname=fenetre;charset=utf8", "root", "");
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}