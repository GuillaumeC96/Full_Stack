<?php

echo "<h1>LES BOUCLES :</h1><br><br>";

echo "<h2>Exercice 1 :</h2><br><br>";
$n = 0;

while ($n < 150) {

    if ($n !== 0 && $n % 2 !== 0) {
        echo $n . " ";
    }

    $n++;
}

$c = 1;

echo "<br><br><h2>Exercice 2 :</h2><br><br>";
while ($c <= 5) {
    echo "Je dois faire des sauvegardes régulières de mes fichiers<br>";
    $c++;
}


echo "<br><br><h2>Exercice 3 :</h2><br><br>";

$h = 0;
$l = 0;

for ($h = 0; $h < 10; $h++) {

    for ($l = 0; $l < 10; $l++) {

        $prod = $l * $h;

        if ($h == 0 && $l == 0) {
            echo "<table border=1 frame=box rules=all><thead><tr><th>$l</th>";
        } else if ($h == 0 && $l > 0 && $l < 9) {
            echo "<th>$l</th>";
        } else if ($h == 0 && $l == 9) {
            echo "<th>$l</th></tr></thead>";
        } else if ($h == 1 && $l == 0) {
            echo "<tbody><tr><td><b>$h<b></td>";
        } else if ($h > 0 && $l == 0) {
            echo "<td><b>$h<b></td>";
        } else if ($h > 0 && $l > 0 && $l < 9) {
            echo "<td>$prod</td>";
        } else if ($h > 0 && $l == 9) {
            echo "<td>$prod</td></tr>";
        } else if ($h == 9 && $l == 9) {
            echo "<td>$l</td></tr></tbody></table>";
        }
    }
}

?>