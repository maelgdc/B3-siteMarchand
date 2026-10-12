<?php
if (isset($_GET["erreur"])) {
    $codeErreur = $_GET["erreur"];
} else
    $codeErreur = 0;

switch ($codeErreur) {
    case 1:
        $ereur = "Pseudo trop court";
        break;
    case 2:
        $ereur = "Veuillez rentrer un mot de passe";
        break;
    case 3:
        $ereur = "Problème de connexion";
        break;
    default:
        $ereur = "";
        break;
}
?>
<h1 class="m-3 text-center">Connexion au site</h1>
<div class="card container">
    <p id="erreur"></p>
    <div class="p-5" id="formLogin">
        <?php
        if ($ereur != "") {
            ?>
            <div class="alert alert-warning">
                <p><?php
                echo $ereur;
                ?></p>
            </div>
            <?php
        }
        ?>
        <form class="m-4" action="./connexionClient_exe.php" method="POST">
            <label for="pseudo">Pseudo :</label><br>
            <input type="text" id="pseudo" name="pseudo" default=""><br><br>

            <label for="motDePasse">Mot de Passe :</label><br>
            <input type="password" id="motDePasse" name="mdp" default=""><br><br>


            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        <a href="./index.php?page=inscription">Pas encore inscrit ? Cliquez ici.</a>
    </div>
</div>