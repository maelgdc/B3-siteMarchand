<?php
if (isset($_GET["erreur"])){
    $codeErreur = $_GET["erreur"] ;
}else $codeErreur = 0;

switch ($codeErreur) {
    case 1:
        $ereur="Login trop court";
        break;
    case 2:
        $ereur= "Veuillez rentrer un mot de passe";
        break;
    case 3:
        $ereur= "Vous n'avez pas accès à cette page";
        break;
    case 4:
        $ereur= "Problème de connexion";
        break;
    default:
        $ereur= "";
        break;
}
?>
        <h1 class="m-3 text-center">Connexion à la page admin</h1>
        <div class="card container">
            <p id="erreur"></p>
            <div class="p-5" id="formLogin">
                <?php
                if ($ereur!=""){
                ?>
                <div class="alert alert-warning">
                    <p><?php
                        echo $ereur;
                    ?></p>
                </div>
                <?php
                }
                ?>
                <form action="./connexion_exe.php" method="POST">
                    <label for="identifiant">Identifiant :</label><br>
                    <input type="text" id="identifiant" name="login" default=""><br><br>

                    <label for="motDePasse">Mot de Passe :</label><br>
                    <input type="password" id="motDePasse" name="mdp" default=""><br><br>


                    <button type="submit" class="btn btn-primary" >Valider</button>
                </form>
            </div>
        </div>
