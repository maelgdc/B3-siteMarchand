<?php
require './info_bdd.php';
$loginCo = $_POST["login"];
$mdpCo = $_POST["mdp"];

if (strlen($loginCo) < 1) {
    header("location:./index.php?page=connexion&erreur=1");
} else if ($mdpCo == "") {
    header("location:./index.php?page=connexion&erreur=2");
} else {
    $requete_sql = "SELECT * FROM users WHERE login='$loginCo'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $resultat = $reponse->fetch(); // récupère tous les résultats
    if ($resultat && $mdpCo == $resultat['mdp']) {
        $tmpPath = __DIR__.'/tmp';
        if(is_dir($tmpPath)){
            session_save_path($tmpPath);
        }
        session_start();
        $_SESSION['user'] = $resultat["login"];
        $_SESSION['role'] = $resultat["role"];
        header("location:./index.php?page=admin&connexion=true");
    } else {
        header("location:./index.php?page=connexion&erreur=4");
    }
}

if (isset($_GET["deco"])) {
    $_SESSION = array();
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Finally, destroy the session.
    session_destroy();
    header("location:./index.php?page=acceuil");
}
?>