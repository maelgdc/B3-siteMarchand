<?php
require './info_bdd.php';

$pseudo = htmlspecialchars($_POST["pseudo"]);
$mdp = htmlspecialchars($_POST["mdp"]);
$mdpConf = htmlspecialchars($_POST["mdpConf"]);
$nom = htmlspecialchars($_POST["nom"]);
$prenom = htmlspecialchars($_POST["prenom"]);
$tel = htmlspecialchars($_POST["tel"]);
$mail = htmlspecialchars($_POST["email"]);


try {
    $requete_sql = "SELECT * FROM client WHERE pseudo='$pseudo'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $clientTest = $reponse->fetchall(); // récupère tous les résultats
} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
}


$resultat = false;
try {
    if (sizeof($clientTest) == 0) {
        $requeteInsertion = "INSERT INTO `client` (`IDCLIENT`, `PSEUDO`, `MDP`, `NOM`, `PRENOM`, `MAIL`, `TEL`) VALUES (NULL, :pseudo, :mdp, :nom, :prenom, :mail, :tel);";
        $statement = $mon_pdo->prepare($requeteInsertion);
        $resultat = $statement->execute([
            ":pseudo" => $pseudo,
            ":mdp" => $mdp,
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":mail" => $mail,
            ":tel" => $tel
        ]);
    } else {
        header("location:./index.php?page=inscription&erreur=3");
    }

} catch (PDOException $monException) {
    echo "Erreur SQL : " . $monException->getMessage();
    header("location:./index.php?page=inscription&erreur=2");
}

$requete_sql = "SELECT * FROM client WHERE pseudo='$pseudo'";
$reponse = $mon_pdo->query($requete_sql); // exécution
$resultat = $reponse->fetch(); // récupère tous les résultats

if ($mdp != $mdpConf) {
    header("location:./index.php?page=inscription&erreur=1");
} else {
    $tmpPath = __DIR__.'/tmp';
    if(is_dir($tmpPath)){
        session_save_path($tmpPath);
    }
    session_start();
    $_SESSION['client'] = $resultat["PSEUDO"];
    $_SESSION['idClient'] = $resultat["IDCLIENT"];
    header("location:./index.php?page=produit&connexion=true");
}

if (isset($_GET["deco"])) {
    session_destroy();
    header("location:./index.php?page=acceuil");
}
?>