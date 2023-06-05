<?php 
echo "LES FONCTIONS<br><br>
Ecrivez une fonction qui permette de générer un lien.";


function createlien($lien,$titre){
    $bouton = "<a href= $lien > $titre </a>";
    echo $bouton;
}

createlien("https://www.reddit.com/", "Reddit Hug");

echo "<br><hr><br>Ecrivez une fonction qui calcul la somme des valeurs d'un tableau<br>
La fonction doit prendre un paramètre de type tableau<br><br>";


$tab = array(4, 3, 8, 2);

$resultat = array_sum($tab);

echo $resultat;




echo "<br><hr><br>Créer une fonction qui vérifie le niveau de complexité d'un mot de passe<br><br>";


$entry = "TopSecret42";
function valide($pass){

$passlen = strlen($pass);

$NBR = array(1,2,3,4,5,6,7,8,9);
$replaceNBR = str_replace($NBR,"",$pass);
$replacelenNBR = strlen($replaceNBR);
$NBRbool = $replacelenNBR < $passlen;

$replaceMAJ = preg_replace('#[A-Z]*#', '',$pass);
$replacelenMAJ = strlen($replaceMAJ);
$MAJbool = $replacelenMAJ < $passlen;

$replaceMIN = preg_replace('#[a-z]*#', '',$pass);
$replacelenMIN = strlen($replaceMIN);
$MINbool = $replacelenMIN < $passlen;

if($NBRbool ==true && $MAJbool==true && $MINbool==true){return true;}
}

echo valide($entry);


?>