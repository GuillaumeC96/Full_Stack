<?php include('head.php'); ?>


<?php include('header.php'); ?>

    
    <form  action="./script/envoicontact.php" method="post">
      <div class="form-group ml-3 mr-3">

        <fieldset>

          <legend>Coordonnées</legend>



          <label for="nom">Votre nom* :</label><input id="nom" name="nom" type="text" class="form-control mb-3"
            title="Entrez votre nom (que des caractères entre a et z)">
          <span id="msgnom" class="mb-3"></span>



          <label for="prenom">Votre prénom* :</label><input id="prenom" name="prenom" type="text" class="form-control mb-3" required
            title="Entrez votre prénom (que des caractères entre a et z)">
          <span id="msgprenom" class="mb-3"></span>



          <label for="sexe">Sexe* :</label><br>

          <input name="sexe" class="mb-3" id="fem" type="radio" value="Femme"><a class="mr-3 ml-2">Femme</a>
          <input name="sexe" class="mb-3" id="hom" type="radio" value="Homme"><a class="mr-3 ml-2">Homme</a>
          <span id="msgsexe" class="mb-3"></span>

          <br>


          <label for="date">Date de naissance* :</label><input name="ddn" id="date" name="date" type="date"
            class="form-control mb-3">
          <span id="msgdate" class="mb-3"></span>



          <label for="postal">Code postal* :</label><input name="postal" id="postal" name="postal" type="text"
            class="form-control mb-3" maxlength="5" required title="Entrez les 5 chiffres de votre code postal">
          <span id="msgpostal" class="mb-3"></span>



          <label for="adresse">Adresse :</label><input name="adresse" id="adresse" name="adresse" type="text" class="form-control mb-3"
            required title="Entrez votre adresse">

          <span id="msgadresse" class="mb-3"></span>



          <label for="ville">Ville :</label><input name="ville" id="ville" name="ville" type="text" class="form-control mb-3"
            required title="Entrez votre Ville">

          <span id="msgville" class="mb-3"></span>

          <label for="email">Email* :</label><input name="email" id="email" name="email" type="text" class="form-control mb-3"
            required title="Entrez votre e-mail">
          <span id="msgemail" class="mb-3"></span>



          <label for="controle">Vérifier l'e-mail* :</label><input name="controle" id="controle" type="text"
            class="form-control mb-3" required title="Vérifier votre e-mail">
          <span id="msgcontrole" class="mb-3"></span>

        </fieldset>



        <fieldset>

          <legend>Votre demande</legend>

          <label for="sujet">Sujet* : </label>
          <select id="sujet" name="sujet" class="form-control mb-3">
            <option value="Veuillez sélectionner un sujet" selected disabled>Sélectionner un sujet</option>
            <option value="Mes commandes">Mes commandes</option>
            <option value="Question sur un produit">Question sur un produit</option>
            <option value="Réclamation">Réclamation</option>
            <option value="Autres">Autres</option>
          </select>



          <span id="msgsujet" class="mb-3"></span>

          <label for="question">Votre question* : </label>
          <textarea name="question" id="question" rows="2" cols="50" class="form-control mb-3"></textarea>

          <span id="msgquestion" class="mb-3"></span>


        </fieldset>



        <input type="checkbox" id="verif" name="verif" class="mb-3"> * J'accepte le traitement informatique de ce formulaire.

        <br>
        <span id="msgverif" class="mb-3"></span>



        <input id="submit" name="submit" type="submit" class="bg-dark rounded text-white p-2" value="Envoyer">
        <input name="reset" type="reset" class="bg-dark rounded text-white p-2" value="Annuler">

      </div>
    </form>



</html>