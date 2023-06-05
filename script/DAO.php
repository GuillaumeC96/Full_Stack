<?php

// on importe le contenu du fichier "db.php"
include('connexion.php');

function categories()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT * FROM categorie WHERE active='Yes'");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();
    //compter les lignes du tableau
    $nb = "Les " . count($tableau) . " catégories :";
    return $tableau;
}

function select_cat()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT * FROM categorie WHERE active='Yes' AND id=$id");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();
    //compter les lignes du tableau
    $nb = "Les " . count($tableau) . " catégories :";
    return $tableau;
}


function plats()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT *  FROM plat WHERE active='Yes'");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();
    return $tableau;
}


function cat_plats()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT * FROM plat WHERE id_categorie=$id");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();

    return $tableau;


}

function lib_cat_plats()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT libelle FROM categorie WHERE id=$id LIMIT 1");
    // on récupère tous les résultats trouvés dans une variable
    $tableau2 = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();

    return $tableau2;


}


function plats_pop()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT *, count(id_plat)
    FROM commande
    JOIN plat ON plat.id=commande.id_plat
    GROUP BY id_plat
    ORDER BY count(id_plat) DESC");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();
    return $tableau;
}


function categorie_pop()
{

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();
    // on lance une requête pour chercher toutes les fiches d'disces
    $requete = $db->query("SELECT categorie.id, categorie.libelle, categorie.image
    FROM commande
    JOIN plat ON plat.id=commande.id_plat
    JOIN categorie ON categorie.id=plat.id_categorie
    GROUP BY plat.id_categorie
    ORDER BY count(plat.id_categorie) DESC");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();
    return $tableau;
}


function delete_cat($ide)
{

    $db = connexionBase();
    //sup les plat de la categorie
    $requete = $db->prepare("DELETE
from `plat`
where id_categorie = :idcat
;");

    $requete->bindValue(":idcat", $ide, PDO::PARAM_STR);

    $requete->execute();
    $requete->closeCursor();
    // sup la categorie
    $requete = $db->prepare("DELETE
    from `categorie`
    where id = :idcat
    ;");

    $requete->bindValue(":idcat", $ide, PDO::PARAM_STR);

    $requete->execute();
    $requete->closeCursor();

}

function update_cat($ide)
{


    /* var_dump($_POST); */

    // Récupération du libelle :
    if (isset($_POST['libelle']) && $_POST['libelle'] != "") {
        $libelle = $_POST['libelle'];
    } else {
        $libelle = Null;
    }

    // Récupération du ACTIVE :
    if (isset($_POST['active']) && $_POST['active'] != "") {
        $active = $_POST['active'];
    } else {
        $active = Null;
    }


    $filename = Null;


    // Récupération et vérification de la photo
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifie si le fichier a été uploadé sans erreur.
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed))
                die("Erreur : Veuillez sélectionner un format de fichier valide.");

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize)
                die("Error: La taille du fichier est supérieure à la limite autorisée.");

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed))

                if (file_exists("./images_the_district/category/" . $_FILES["photo"]["name"])) {
                    echo $filename . " existe déjà.";
                } else {
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "./images_the_district/category/" . $_FILES["photo"]["name"]);
                    echo "Votre fichier a été téléchargé avec succès.";

                } else {
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else {
            echo "Error: " . $_FILES["photo"]["error"];
        }
    }



    $db = connexionBase();

    if ($filename == Null) {
        $filename = $_POST['hidpic'];
    }

    try {
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("UPDATE categorie SET libelle=:libelle, active=:active, image=:image WHERE id= $ide;");


        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":libelle", $libelle, PDO::PARAM_STR);
        $requete->bindValue(":active", $active, PDO::PARAM_STR);
        $requete->bindValue(":image", $filename, PDO::PARAM_STR);




        // Lancement de la requête :
        $requete->execute();

        // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
        $requete->closeCursor();
    }

    // Gestion des erreurs
    catch (Exception $e) {
        var_dump($requete->queryString);
        var_dump($requete->errorInfo());
        echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
        die("Fin du script)");
    }

    // Si OK: redirection vers la page artists.php
    header("Location: admin_categorie.php");

    // Fermeture du script
    exit;

}


function create_cat()
{


    var_dump($_POST);

    // Récupération du libelle :
    if (isset($_POST['libelle']) && $_POST['libelle'] != "") {
        $libelle = $_POST['libelle'];
    } else {
        $libelle = Null;
    }

    // Récupération du ACTIVE :
    if (isset($_POST['active']) && $_POST['active'] != "") {
        $active = $_POST['active'];
    } else {
        $active = Null;
    }


    $filename = Null;


    // Récupération et vérification de la photo
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifie si le fichier a été uploadé sans erreur.
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["photo"]["name"];
            $filetype = $_FILES["photo"]["type"];
            $filesize = $_FILES["photo"]["size"];

            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed))
                die("Erreur : Veuillez sélectionner un format de fichier valide.");

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize)
                die("Error: La taille du fichier est supérieure à la limite autorisée.");

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed))

                if (file_exists("./images_the_district/category/" . $_FILES["photo"]["name"])) {
                    echo $filename . " existe déjà.";
                } else {
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "./images_the_district/category/" . $_FILES["photo"]["name"]);
                    echo "Votre fichier a été téléchargé avec succès.";

                } else {
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else {
            echo "Error: " . $_FILES["photo"]["error"];
        }
    }



    $db = connexionBase();

    if ($filename == Null) {
        $filename = $_POST['hidpic'];
    }

    try {
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("INSERT INTO categorie (libelle, active, image)
    VALUES (:libelle, :active, :filename);");


        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":libelle", $libelle, PDO::PARAM_STR);
        $requete->bindValue(":active", $active, PDO::PARAM_INT);
        $requete->bindValue(":image", $filename, PDO::PARAM_STR);




        // Lancement de la requête :
        $requete->execute();

        // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
        $requete->closeCursor();
    }

    // Gestion des erreurs
    catch (Exception $e) {
        var_dump($requete->queryString);
        var_dump($requete->errorInfo());
        echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
        die("Fin du script)");
    }

    // Si OK: redirection vers la page artists.php
    header("Location: admin_categorie.php");

    // Fermeture du script
    exit;

}



function envoi_contact()
{


    var_dump($_POST);

    // Récupération du nom :
    if (isset($_POST['nom']) && $_POST['nom'] != "") {
        $nom = $_POST['nom'];
    } else {
        $nom = Null;
    }


    // Récupération du prenom :
    if (isset($_POST['prenom']) && $_POST['prenom'] != "") {
        $prenom = $_POST['prenom'];
    } else {
        $prenom = Null;
    }

    // Récupération du sexe :
    if (isset($_POST['sexe']) && $_POST['sexe'] != "") {
        $sexe = $_POST['sexe'];
    } else {
        $sexe = Null;
    }

       // Récupération du ddn :
       if (isset($_POST['ddn']) && $_POST['ddn'] != "") {
        $ddn = $_POST['ddn'];
    } else {
        $ddn = Null;
    }

    // Récupération du postal :
    if (isset($_POST['postal']) && $_POST['postal'] != "") {
        $postal = $_POST['postal'];
    } else {
        $postal = Null;
    }
    
// Récupération du adresse :
if (isset($_POST['adresse']) && $_POST['adresse'] != "") {
    $adresse = $_POST['adresse'];
} else {
    $adresse = Null;
}


// Récupération du ville :
if (isset($_POST['ville']) && $_POST['ville'] != "") {
    $ville = $_POST['ville'];
} else {
    $ville = Null;
}

// Récupération du email :
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $_POST['email'];
} else {
    $email = Null;
}


// Récupération du sujet :
if (isset($_POST['sujet']) && $_POST['sujet'] != "") {
    $sujet = $_POST['sujet'];
} else {
    $sujet = Null;
}


// Récupération du question :
if (isset($_POST['question']) && $_POST['question'] != "") {
    $question = $_POST['question'];
} else {
    $question = Null;
}


// Récupération du verif :
if (isset($_POST['verif']) && $_POST['verif'] != "") {
    $verif = $_POST['verif'];
} else {
    $verif = Null;
}


    $db = connexionBase();


    try {
        // Construction de la requête INSERT sans injection SQL :
        $requete = $db->prepare("INSERT INTO contact (nom, prenom, sexe, naissance, postal, adresse, ville, email, sujet , question, verif)
    VALUES (:nom, :prenom, :sexe, :naissance, :postal, :adresse, :ville, :email, :sujet , :question, :verif);");


        // Association des valeurs aux paramètres via bindValue() :
        $requete->bindValue(":nom", $nom, PDO::PARAM_STR);
        $requete->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $requete->bindValue(":sexe", $sexe, PDO::PARAM_STR);
        $requete->bindValue(":naissance", $ddn, PDO::PARAM_STR);
        $requete->bindValue(":postal", $postal, PDO::PARAM_STR);
        $requete->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $requete->bindValue(":ville", $ville, PDO::PARAM_STR);
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
        $requete->bindValue(":sujet", $sujet, PDO::PARAM_STR);
        $requete->bindValue(":question", $question, PDO::PARAM_STR);
        $requete->bindValue(":verif", $verif, PDO::PARAM_BOOL);




        // Lancement de la requête :
        $requete->execute();

        // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
        $requete->closeCursor();
    }

    // Gestion des erreurs
    catch (Exception $e) {
        var_dump($requete->queryString);
        var_dump($requete->errorInfo());
        echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
        die("Fin du script)");
    }

    // Si OK: redirection vers la page artists.php
    header("Location: confirmation_contact.php");

    // Fermeture du script
    exit;

}



?>