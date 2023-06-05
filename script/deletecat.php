<?php
//delete_cat($categorie->id)
include('DAO.php');

$ide = $_POST['idcat'];
delete_cat($ide);
header('Location:../admin_categorie.php');

?>