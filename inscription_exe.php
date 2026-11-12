<?php
require './info_bdd.php';
require './gestion_secrets.php';

$crypt_key = $_ENV['encryption'];

$pseudo = htmlspecialchars($_POST["pseudo"]);
$pseudo_chif = chiffrer_donnee($pseudo, $crypt_key);
$mdp = htmlspecialchars($_POST["mdp"]);
$mdp_hash = hasher_mdp($mdp);
$mdpConf = htmlspecialchars($_POST["mdpConf"]);
$nom = htmlspecialchars($_POST["nom"]);
$nom_chif = chiffrer_donnee($nom, $crypt_key);
$prenom = htmlspecialchars($_POST["prenom"]);
$prenom_chif = chiffrer_donnee($prenom, $crypt_key);
$tel = htmlspecialchars($_POST["tel"]);
$tel_chif = chiffrer_donnee($tel, $crypt_key);
$mail = htmlspecialchars($_POST["email"]);
$mail_chif = chiffrer_donnee($mail, $crypt_key);
$clientTest = null;

try {
    $requete_sql = "SELECT * FROM client WHERE pseudo = :pseudo";

    $reponse = $mon_pdo->prepare($requete_sql);

    $reponse->execute([
        ':pseudo' => $pseudo_chif
    ]);

    $clientTest = $reponse->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
}

if ($mdp != $mdpConf) {
    header("location:./index.php?page=inscription&erreur=1");
} else {
    $resultat = false;
    try {
        echo(sizeof($clientTest));
        if (sizeof($clientTest) == 0) {
            $requeteInsertion = "INSERT INTO `client` (`IDCLIENT`, `PSEUDO`, `MDP`, `NOM`, `PRENOM`, `MAIL`, `TEL`) VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :mail, :tel);";
            $statement = $mon_pdo->prepare($requeteInsertion);
            $resultat = $statement->execute([
                ":pseudo" => $pseudo_chif,
                ":mdp" => $mdp_hash,
                ":nom" => $nom_chif,
                ":prenom" => $prenom_chif,
                ":mail" => $mail_chif,
                ":tel" => $tel_chif
            ]);
        } else {
            header("location:./index.php?page=inscription&erreur=3");
        }
    } catch (PDOException $monException) {
        echo "Erreur SQL : " . $monException->getMessage();
        header("location:./index.php?page=inscription&erreur=2");
    }
    $requete_sql = "SELECT * FROM client WHERE pseudo=:pseudo_chif";
    $reponse = $mon_pdo->prepare($requete_sql);
    $reponse->execute([
        ':pseudo_chif' => $pseudo_chif
    ]);

    $resultat = $reponse->fetch(PDO::FETCH_ASSOC);

    $tmpPath = __DIR__ . '/tmp';
    if (is_dir($tmpPath)) {
        session_save_path($tmpPath);
    }
    session_start();
    $_SESSION['client'] = dechiffrer_donnee($resultat["PSEUDO"], $crypt_key);
    $_SESSION['idClient'] = $resultat["IDCLIENT"];
    header("location:./index.php?page=produit&connexion=true");
}

if (isset($_GET["deco"])) {
    session_destroy();
    header("location:./index.php?page=acceuil");
}
