<?php
require './info_bdd.php';
$page_autorise=['acceuil','produit','admin','connexion','connexionClient','inscription','detailProduit','commande_exe','panier','gestionCommande_exe','commande','apropos','mentionLegales'];

if (isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page='acceuil';
}

if (!in_array($page,$page_autorise)){
    $page='acceuil';
}

include './header.php';
include $page.'.php';
include './footer.php';
?>