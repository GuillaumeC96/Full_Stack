<?php include('head.php'); ?>



<?php include('header.php'); ?>

<?php include('./script/DAO.php'); ?>

<?php
$tableau = select_cat();


?>



<?php foreach ($tableau as $cat): ?>
    <div class="d-inline-flex p-3">

        <div class=" mx-6 my-2 pb-3">

            <a class="font-weight-bold display-6 text-decoration-none text-dark">
                <?= $cat->libelle ?>
            </a>

            <br>

            <img style="height: 265px" class="mt-3" src="./images_the_district/category/<?= $cat->image ?>">


            <h2 class="pt-3 mb-3">Modifier</h2>

            <form action="./script/updatecat.php" method="post" enctype="multipart/form-data">

                <label for="nom">Nom catégorie :</label><br>
                <input type="text" name="libelle" id="libelle" class="mb-3" value="<?= $cat->libelle ?>">
                <br>

                <label for="active">Active :</label><br>
                <input type="text" name="active" id="active" class="mb-3" value="<?= $cat->active ?>">
                <br>

                <label for="photo">Image de la catégorie :</label><br>
                <input type="file" id="photo" name="photo">

                <br>

                <input type="hidden" name="hidpic" id="hidpic" value="<?= $cat->image ?>">
                <input type="hidden" name="hidden" id="hidden" value="<?= $cat->id ?>">
                <input type="text" name="idcat" value="<?= $cat->id ?>" hidden>

                <input type="submit" value="Modifier" class="btn bg-black text-white fw-bold my-4">

            </form>

        </div>
    </div>

<?php endforeach; ?>


<?php include('foot.php'); ?>