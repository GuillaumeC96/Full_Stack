<?php 


function ConnexionBase() {

    try 
    {
        $connexion = new PDO('mysql:host=localhost;charset=utf8;dbname=the_district', 'admin', '<VotreMotDePasse>');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connexion;

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage() . "<br>";
        echo "N° : " . $e->getCode();
        die("Fin du script");
    }
}








/*new PDO('mysql:host=localhost;charset=utf8;dbname=the_district', 'admin', '<VotreMotDePasse>');*/

/*new PDO('mysql:host=localhost;dbname=guillaumec96', 'guillaumec96', 'afpa010203');*/
?>


