

<?php include('mail.php'); ?>

<?php

$datej = date("Y-m-d H:i:s");
$etat = "Non approuvé";

// Récupération du nom :
if (isset($_POST['nom']) && $_POST['nom'] != "") {
    $nom = $_POST['nom'];
} else {
    $nom = Null;
}

// Récupération du telephone :
if (isset($_POST['telephone']) && $_POST['telephone'] != "") {
    $telephone = $_POST['telephone'];
} else {
    $telephone = Null;
}

// Récupération du mail :
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $_POST['email'];
} else {
    $email = Null;
}

// Récupération adresse :
if (isset($_POST['adresse']) && $_POST['adresse'] != "") {
    $adresse = $_POST['adresse'];
} else {
    $adresse = Null;
}

// Récupération du ID :
if (isset($_POST['identifiant']) && $_POST['identifiant'] != "") {
    $identifiant = $_POST['identifiant'];
} else {
    $identifiant = Null;
}

// Récupération du ID :
if (isset($_POST['quantite']) && $_POST['quantite'] != "") {
    $quantite = $_POST['quantite'];
} else {
    $quantite = Null;
}

// Récupération du ID :
if (isset($_POST['prix']) && $_POST['prix'] != "") {
    $prix = $_POST['prix'];
} else {
    $prix = Null;
}



if($quantite && $prix){
$total = $quantite*$prix;
}

/* var_dump($_POST); */
/* var_dump($datej);
var_dump($total);
var_dump($etat); */


// S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
require "connexion.php";
$db = connexionBase();


try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO commande (id_plat, quantite, date_commande, total, etat, nom_client, telephone_client, email_client, adresse_client)
    VALUES (:identifiant, :quantite, :datej, :total, :etat, :nom, :telephone, :email, :adresse);");
 

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":identifiant", $identifiant, PDO::PARAM_INT);
    $requete->bindValue(":quantite", $quantite, PDO::PARAM_INT);
    $requete->bindValue(":datej", $datej, PDO::PARAM_STR);
    $requete->bindValue(":total", $total);
    $requete->bindValue(":etat", $etat, PDO::PARAM_STR);
    $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
    $requete->bindValue(":telephone", $telephone, PDO::PARAM_STR);
    $requete->bindValue(":email", $email, PDO::PARAM_STR);
    $requete->bindValue(":adresse", $adresse, PDO::PARAM_STR);
    
    

    // Lancement de la requête :
    $requete->execute();

    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();
}

// Gestion des erreurs
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " .$e->getMessage() . "<br>";
    die("Fin du script (script_commande.php)");
}


envoi_mail_commande($nom);

// Si OK: redirection vers la page php
header("Location: ../commande_valide.php");


// Fermeture du script
exit;
?>