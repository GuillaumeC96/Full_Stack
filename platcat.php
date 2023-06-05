<?php include('head.php'); ?>


<?php include('header.php'); ?>

<?php include('script/DAO.php'); ?>

<?php

$tableauplatcat = cat_plats();

$libelle = lib_cat_plats();



if (count($tableauplatcat) == 1) {
    $pl = " plat";
} else {
    $pl = " plats";
}


//compter les lignes du tableau
$nb = count($tableauplatcat) . $pl;

?>


<div class="p-3">

    <?php foreach ($libelle as $lib): ?>
        <h1>
            <?= $lib->libelle ?>
        </h1><br>
    <?php endforeach; ?>

    <h1><?= $nb ?></h1>
</div>

<div class="d-flex flex-wrap">



    <?php foreach ($tableauplatcat as $plat): ?>
        <div class="d-inline-flex p-5">

            <div>
                <a href="presentation.php?id=<?= $plat->id ?>"
                    class="font-weight-bold display-6 text-decoration-none text-dark rounded bg-white p-2">
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



<?php include('foot.php'); ?>