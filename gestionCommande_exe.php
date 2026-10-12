<?php
require './info_bdd.php';

$numCommande = $_GET['numCommande'];
$idproduit= $_GET['idproduit'];
$action= $_GET['action'];

$requete_sql = "SELECT * FROM produit WHERE idProduit='$idproduit'";
$reponse = $mon_pdo->query($requete_sql); // exécution
$produit = $reponse->fetch(); // récupère tous les résultats

$requete_sql = "SELECT * FROM contenir WHERE numCommande='$numCommande' AND idProduit='$idproduit'";
$reponse = $mon_pdo->query($requete_sql); // exécution
$contenir = $reponse->fetch(); // récupère tous les résultats

if ($action== 'supprimer') {
    $requete_sql = "DELETE FROM contenir WHERE numCommande='$numCommande' AND idProduit='$idproduit'";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    $stock=$produit['STOCK']+$contenir['QUANTITE'];
    $requete_sql = "UPDATE `produit` SET `STOCK` = '$stock' WHERE `produit`.`IDPRODUIT` =' $idproduit' ";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    header("location:./index.php?page=panier");
}

if ($action== "valider") {
    $requete_sql = "UPDATE `commande` SET `IDSTATUT` = 'VAL', `date` = NOW() WHERE `commande`.`NUMCOMMANDE` =' $numCommande';";
    $reponse = $mon_pdo->query($requete_sql); // exécution
    header("location:./index.php?page=panier");
}

?>