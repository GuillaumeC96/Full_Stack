<?php



echo "Trouvez le numéro de semaine de la date suivante : 14/07/2019.<br><br>";


$date = "2019-07-14";
$format = strtotime ($date);
echo date('W',$format);


echo "<br><hr><br>Combien reste-t-il de jours avant la fin de votre formation ?<br><br>";


$origin = date_create('2023-04-28');
$target = date_create('2023-06-02');
$interval = date_diff($origin, $target);
echo $interval->format('%a jours');


echo "<br><hr><br>Comment déterminer si une année est bissextile ?<br><br>";


$an = 2023;
$mod4= $an%4;
$mod100= $an%100;
$bis="";
if($mod4==0 && $mod100!==0){$bis="$an est bissextile";}else{$bis="$an est non bissextile";}
echo $bis;


echo "<br><hr><br>Montrez que la date du 32/17/2019 est erronée.<br><br>";


function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

if(validateDate('2019-17-32', 'Y-m-d')==true){echo "La date est valide";}
else{echo "La date n'est pas valide";}


echo "<br><hr><br>Affichez l'heure courante sous cette forme : 11h25.<br><br>";


date_default_timezone_set('Europe/Paris');
$date = date('h')."h".date('i');
echo $date;


echo "<br><hr><br>Ajoutez 1 mois à la date courante.<br><br>";


echo date('d-m-y',strtotime('+1 month',time()));


echo "<br><hr><br>Que s'est-il passé le 1000200000 ?<br><br>";


echo date('d-m-y',1000200000);



?>

