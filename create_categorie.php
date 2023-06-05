<?php include('head.php'); ?>



<?php include('header.php'); ?>

<?php include('./script/DAO.php'); ?>


<div class="p-3">
            <h1 class="pt-3 mb-3">Créer une catégorie</h1>

            <form action="./script/createcat.php" method="post">

                <label for="nom">Nom catégorie :</label><br>
                <input type="text" name="nom" id="nom" class="mb-3" >
                <br>

                <label for="active">Active :</label><br>
                <input type="text" name="active" id="active" class="mb-3">
                <br>

                <label for="photo">Image de la catégorie :</label><br>
                <input type="file" id="photo" name="photo">

                <br>

                <input type="submit" value="Créer" class="btn bg-black text-white fw-bold my-4">

            </form>

 

    </div>


<?php include('foot.php'); ?>