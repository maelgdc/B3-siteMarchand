<?php
if (isset($_GET["erreur"])) {
    $codeErreur = $_GET["erreur"];
} else
    $codeErreur = 0;

switch ($codeErreur) {
    case 1:
        $ereur = "Mot de passe et confirmation différents !";
        break;
    case 2:
        $ereur = "Erreur dans la connexion BDD !";
        break;
    case 3:
        $ereur = "Ce couple mot de passe / pseudo existe déjà.";
        break;
    default:
        $ereur = "";
        break;
}
?>
<h1 class="m-3 text-center">Inscription client</h1>
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
        <form class="d-flex flex-column" action="./inscription_exe.php" method="POST">
            <div class="m-4 d-flex justify-content-evenly">
                <div>
                    <label for="pseudo">Pseudo : *</label><br>
                    <input required type="text" id="identifiant" name="pseudo" default=""><br><br>

                    <label for="motDePasse">Mot de Passe : *</label><br>
                    <input required type="password" id="motDePasse" name="mdp" default=""><br><br>

                    <label for="motDePasseConf">Confirmation Mot de Passe : *</label><br>
                    <input required type="password" id="motDePasseConf" name="mdpConf" default=""><br><br>

                    <label for="nom">Nom : *</label><br>
                    <input required type="text" id="nom" name="nom" default=""><br><br>
                </div>
                <div>
                    <label for="prenom">Prenom : *</label><br>
                    <input required type="text" id="prenom" name="prenom" default=""><br><br>

                    <label for="tel">Tel :</label><br>
                    <input type="tel" id="tel" name="tel" default=""><br><br>

                    <label for="email">Email :</label><br>
                    <input type="email" id="email" name="email" default=""><br><br>

                </div>
            </div>
            <button type="submit" class="btn btn-primary " style="width: 150px; margin : auto;">Valider</button>
        </form>
    </div>
</div>