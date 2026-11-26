<?php

if (isset($_GET["deco"])) {
    error_log("Déconnexion du compte du client n°" .  $_SESSION['idClient'],0);
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
    exit;
}
$pseudoCo = htmlspecialchars($_POST["pseudo"]);
$mdpCo = htmlspecialchars($_POST["mdp"]);

require './info_bdd.php';
require './gestion_secrets.php';

$crypt_key = $_ENV['encryption'];

$pseudo_chif = chiffrer_donnee($pseudoCo, $crypt_key);

$requete_sql = "SELECT * FROM client WHERE pseudo = :pseudo";

$reponse = $mon_pdo->prepare($requete_sql);

$reponse->execute([
    ':pseudo' => $pseudo_chif
]);



$client = $reponse->fetch(PDO::FETCH_ASSOC);
if ($client!=null && verifier_mdp($mdpCo, $client['MDP'])) {
    
    $tmpPath = __DIR__ . '/tmp';
    if (is_dir($tmpPath)) {
        session_save_path($tmpPath);
    }
    session_start();
    $_SESSION['client'] = dechiffrer_donnee($client["PSEUDO"], $crypt_key);
    $_SESSION['idClient'] = $client["IDCLIENT"];
    error_log("Réussite de la connexion au compte du client n°" .  $_SESSION['idClient'],0);
     header("location:./index.php?page=produit&connexion=true");
} else {
    if ($client==null){
        error_log("Echec de la connexion, client inexistant : " . $pseudoCo,0);
    }
    if ($client!=null && !verifier_mdp($mdpCo, $client['MDP'])){
        error_log("Echec de la connexion, MdP incorrect, au compte du client n°" .  $client["IDCLIENT"],0);
    }
     header("location:./index.php?page=connexionClient&erreur=1");
}




