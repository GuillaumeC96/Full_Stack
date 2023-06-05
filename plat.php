<?php include('head.php'); ?>



<?php include('header.php'); ?>



<?php


// on importe le contenu du fichier "DAO.php"
include('./script/DAO.php');
$tableauplat = plats();


$nb = "Les " . count($tableauplat) . " plats :";

?>


<h1 class="px-5">
    <?= $nb ?>
</h1>

<div class="d-flex flex-wrap">

    <?php foreach ($tableauplat as $plat): ?>
        <div class="d-inline-flex mx-6">

            <div class="p-5">

                <a href="presentation.php?id=<?= $plat->id ?>"
                    class="font-weight-bold display-5 text-decoration-none text-dark rounded bg-white p-2">
                    <?= $plat->libelle ?>
                </a>

                <br>

                <a href="presentation.php?id=<?= $plat->id ?>"><img href="presentation.php?id=<?= $plat->id ?>"
                        style="height: 265px" src="./images_the_district/food/<?= $plat->image ?>"></a>

                <br>

                <a href="presentation.php?id=<?= $plat->id ?>"
                    class="font-weight-bold display-6 text-decoration-none text-dark rounded bg-white p-2">
                    <?= $plat->prix ?> €
                </a>


            </div>

        </div>
    <?php endforeach; ?>


</div>
</div>
<?php include('foot.php'); ?>