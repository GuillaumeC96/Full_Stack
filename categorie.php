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
                        <div class="d-inline-flex mx-6">

                            <div class="p-5">

                                <a href="platcat.php?id=<?= $categorie->id ?>"
                                    class="font-weight-bold display-5 text-decoration-none text-dark rounded bg-white p-2">
                                    <?= $categorie->libelle ?>
                                </a>

                                <br>

                                <a href="platcat.php?id=<?= $categorie->id ?>"><img
                                        href="platcat.php?id=<?= $categorie->id ?>" style="height: 265px"
                                        src="./images_the_district/category/<?= $categorie->image ?>"></a>

                        


                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>
         
    
<?php include('foot.php'); ?>