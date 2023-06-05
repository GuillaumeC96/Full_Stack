<?php include('head.php'); ?>



        <?php include('header.php'); ?>

        <?php

        // on importe le contenu du fichier "db.php"
        include('./script/connexion.php');
        // on exécute la méthode de connexion à notre BDD
        $db = connexionBase();
        // On récupère l'ID passé en paramètre :
        $id = $_GET["id"];
        // on lance une requête pour chercher toutes les fiches d'disces
        $requete = $db->query("SELECT * FROM plat WHERE id=$id ORDER BY id DESC LIMIT 1");
        // on récupère tous les résultats trouvés dans une variable
        $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
        // on clôt la requête en BDD
        $requete->closeCursor();

        ?>



                <?php foreach ($tableau as $plat): ?>
                    <div class="d-inline-flex p-3">

                        <div class=" mx-6 my-2 pb-3">

                            <a class="font-weight-bold display-6 text-decoration-none text-dark">
                                <?= $plat->libelle ?>
                            </a>

                            <br>

                            <img style="height: 265px" class="mt-3" src="./images_the_district/food/<?= $plat->image ?>">

                            <p class="text-dark mt-3">
                                <?= $plat->description ?>
                            </p>

                            <a href="platcat.php?id=<?= $plat->id ?>"
                                class="font-weight-bold display-6 text-decoration-none text-dark">
                                <?= $plat->prix ?> €
                            </a>

                            <h2 class="pt-3 mb-3">Commander</h2>

                            <form action="./script/script_commande.php" method="post">

                                <label for="nom">Nom :</label><br>
                                <input type="text" name="nom" id="nom" class="mb-3">
                                <br>

                                <label for="telephone">Telephone :</label><br>
                                <input type="text" name="telephone" id="telephone" class="mb-3">
                                <br>

                                <label for="email">Email :</label><br>
                                <input type="text" name="email" id="adresse" class="mb-3">
                                <br>

                                <label for="adresse">Adresse :</label><br>
                                <input type="text" name="adresse" id="adresse" class="mb-3">
                                <br>

                                <input type="hidden" name="identifiant" id="identifiant" value="<?= $plat->id ?>">
                                <input type="hidden" name="prix" id="prix" value=<?= $plat->prix ?>>

                                <label for="quantite">Quantité :</label><br>
                                <input type="number" name="quantite" id="quantite" value=1>
                                <br>
                                
                                <input type="submit" value="Ajouter" class="btn bg-black text-white fw-bold my-4">

                            </form>

                        </div>
                    </div>

                <?php endforeach; ?>


            <?php include('foot.php'); ?>
