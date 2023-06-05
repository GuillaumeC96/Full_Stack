
<?php

/*Écrire un programme qui lit ce fichier et qui construit une page web contenant une liste de liens hypertextes.*/

$lines = file('https://ncode.amorce.org/ressources/Pool/NEW_MS_FULL_STACK/WEB_PHP/liens.txt');

foreach ($lines as $line_num => $line) {
    echo "<a href='" . htmlspecialchars($line) . "'>$line.</a><br>\n";
}


?>
