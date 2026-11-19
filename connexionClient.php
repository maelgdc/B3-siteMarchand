<?php
$erreur = isset($_GET["erreur"]) ? "Problème de connexion" : null;
?>
<h1 class="m-3 text-center">Connexion au site</h1>
<div class="card container">
    <p id="erreur"></p>
    <div class="p-5" id="formLogin">
        <?php
        if ($erreur != null) {
            ?>
            <div class="alert alert-warning">
                <p><?php
                echo $erreur;
                ?></p>
            </div>
            <?php
        }
        ?>
        <form class="m-4" action="./connexionClient_exe.php" method="POST">
            <label for="pseudo">Pseudo :</label><br>
            <input type="text" id="pseudo" name="pseudo" default="" required><br><br>

            <label for="motDePasse">Mot de Passe :</label><br>
            <input type="password" id="motDePasse" name="mdp" default="" required><br><br>


            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <a href="./index.php?page=inscription">Pas encore inscrit ? Cliquez ici.</a>
    </div>
</div>