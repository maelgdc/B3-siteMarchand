<?php
$pseudoCo = $_POST["pseudo"];
$mdpCo = $_POST["mdp"];

require './info_bdd.php';
if (strlen($pseudoCo) < 1) {
    header("location:./index.php?page=connexionClient&erreur=1");
} else if ($mdpCo == "") {
    header("location:./index.php?page=connexionClient&erreur=2");
} else {
    $requete_sql = "SELECT * FROM client WHERE pseudo='$pseudoCo'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $resultat = $reponse->fetch(); // récupère tous les résultats
    if ($resultat && $mdpCo == $resultat['MDP']) {
        $tmpPath = __DIR__.'/tmp';
        if(is_dir($tmpPath)){
            session_save_path($tmpPath);
        }
        session_start();
        $_SESSION['client'] = $resultat["PSEUDO"];
        $_SESSION['idClient'] = $resultat["IDCLIENT"];
        header("location:./index.php?page=produit&connexion=true");
    } else {
        header("location:./index.php?page=connexion&erreur=3");
    }

}

if (isset($_GET["deco"])) {
    $_SESSION = array();
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    // Finally, destroy the session.
    session_destroy();
    header("location:./index.php?page=acceuil");
}
?>