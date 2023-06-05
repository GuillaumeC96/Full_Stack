<?php include('head.php'); ?>



<?php include('header.php'); ?>

<?php include('./script/DAO.php'); ?>



<?php

$tableaucat = categories();


$nb = "Les " . count($tableaucat) . " catégories :";



?>



<h1 class="px-5">
    <?= $nb ?>
</h1>

<div class="d-flex flex-wrap">

    <?php foreach ($tableaucat as $categorie): ?>
        <div class="d-inline-flex p-3">

            <div class="p-5">

                <a href="platcat.php?id=<?= $categorie->id ?>"
                    class="font-weight-bold display-5 text-decoration-none text-dark rounded bg-white p-2">
                    <?= $categorie->libelle ?>
                </a>

                <br>

                <a href="platcat.php?id=<?= $categorie->id ?>"><img href="platcat.php?id=<?= $categorie->id ?>"
                        style="height: 265px" src="./images_the_district/category/<?= $categorie->image ?>"></a>


                        <div class="d-flex flex-wrap">

                        <form action=modif_cat(<?= $categorie->id ?>) method="post" >
                        <a href="update_categorie.php?id=<?= $categorie->id ?>" class="btn bg-black text-white fw-bold mr-3 mt-3">Modifier</a>
                </form>


                <form action=./script/deletecat.php method="post" >
                <input type="text" name="idcat" value="<?= $categorie->id ?>" hidden>
                <input type="text" name="namecat" value="<?= $categorie->libelle ?>" hidden>
                    <input type="submit" value="Supprimer" class="btn bg-black text-white fw-bold mr-3 mt-3">
                </form>
    </div>

            </div>

        </div>
    <?php endforeach; ?>

</div>


<?php include('foot.php'); ?>