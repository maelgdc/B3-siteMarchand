<?php
require './info_bdd.php';
$tmpPath = __DIR__ . '/tmp';
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();

$quantite = $_POST["quantite"];
$idclient = $_SESSION['idClient'];
$idproduit = $_GET['idproduit'];

$requete_sql = "SELECT NUMCOMMANDE FROM commande WHERE idClient='$idclient' AND idStatut='ENC'";
$reponse = $mon_pdo->query($requete_sql); // exécution
$commande = $reponse->fetch(); // récupère tous les résultats

$requete_sql = "SELECT * FROM produit WHERE idProduit='$idproduit'";
$reponse = $mon_pdo->query($requete_sql); // exécution
$produit = $reponse->fetch(); // récupère tous les résultats

if ($commande) {
    $numCommande = $commande['NUMCOMMANDE'];
    $requete_sql = "SELECT * FROM contenir WHERE numCommande='$numCommande' AND idProduit='$idproduit'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $testContenir = $reponse->fetch(); // récupère tous les résultats
    $stock=$produit['STOCK']-$quantite;
    $requete_sql = "UPDATE `produit` SET `STOCK` = '$stock' WHERE `produit`.`IDPRODUIT` =' $idproduit' ";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    header("location:./index.php?page=panier");
    if ($testContenir) {
        $quantite = $quantite + $testContenir["QUANTITE"];
        $requete_sql = "UPDATE `contenir` SET `QUANTITE` = '$quantite' WHERE `contenir`.`NUMCOMMANDE` =' $numCommande' AND `contenir`.`IDPRODUIT` =' $idproduit' ";
        $reponse = $mon_pdo->query($requete_sql); // exécution
    } else {
        $requete_sql = "INSERT INTO `contenir` (`NUMCOMMANDE`, `IDPRODUIT`, `QUANTITE`) VALUES ('$numCommande', '$idproduit', '$quantite');";
        $reponse = $mon_pdo->query($requete_sql); // exécution
    }
} else {
    $requete_sql = "INSERT INTO `commande` (`NUMCOMMANDE`, `IDCLIENT`, `IDSTATUT`, `DATE`) VALUES (NULL, '$idclient', 'ENC', NOW());";
    echo $requete_sql;
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $requete_sql = "SELECT NUMCOMMANDE FROM commande WHERE idClient='$idclient' AND idStatut='ENC'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $commande = $reponse->fetch(); // récupère tous les résultats
    $numCommande = $commande['NUMCOMMANDE'];
    $requete_sql = "SELECT * FROM contenir WHERE numCommande='$numCommande' AND idProduit='$idproduit'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $testContenir = $reponse->fetch(); // récupère tous les résultats
    $stock=$produit['STOCK']-$quantite;
    $requete_sql = "UPDATE `produit` SET `STOCK` = '$stock' WHERE `produit`.`IDPRODUIT` =' $idproduit' ";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    header("location:./index.php?page=panier");
    if ($testContenir) {
        $quantite = $quantite + $testContenir["QUANTITE"];
        $requete_sql = "UPDATE `CONTENIR` SET `QUANTITE` = '$quantite' WHERE `contenir`.`NUMCOMMANDE` =' $numCommande' AND `contenir`.`IDPRODUIT` =' $idproduit' ";
        $reponse = $mon_pdo->query($requete_sql); // exécution
    } else {
        $requete_sql = "INSERT INTO `contenir` (`NUMCOMMANDE`, `IDPRODUIT`, `QUANTITE`) VALUES ('$numCommande', '$idproduit', '$quantite');";
        $reponse = $mon_pdo->query($requete_sql); // exécution
    }
}