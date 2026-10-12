<?php
if (isset($_POST["categorie"]) && $_POST["categorie"]!=0){
    $cate=$_POST["categorie"];
    $requete_sql = "SELECT * FROM produit WHERE idCategorie='$cate'";
}
else {
    $requete_sql = "SELECT * FROM produit ORDER BY idCategorie";
}
$reponse = $mon_pdo->query($requete_sql); // exécution
$liste_produits = $reponse->fetchall(); // récupère tous les résultats

$requete_sql = "SELECT * FROM categorie";
$reponse = $mon_pdo->query($requete_sql); // exécution
$liste_categories = $reponse->fetchall(); // récupère tous les résultats
?>

<div class="container text-center m-auto p-2">
<label for="categorie-select">Choisissez une catégorie</label>
<form action="./index.php?page=produit" method="POST">
    <select name="categorie" id="categorie-select" onchange="submit()">
        <option value="0">Toutes les catégories</option>
        <?php
        foreach ($liste_categories as $categorie) {
            ?>
            <option value="<?php echo $categorie['IDCATEGORIE'] ?>"><?php echo $categorie['IDCATEGORIE'] ?> -
                <?php echo $categorie['LIBELLECATEGORIE'] ?></option>
        <?php } ?>
    </select>
</form>
</div>
<div class="w-75 container ">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3 justify-content-evenly">
        <?php
        foreach ($liste_produits as $produit) {
            ?>
            <div class="card col text-center m-4">
                <img style="height: 300px; object-fit: contain;" class="card-img-top mt-4"
                    src="<?php echo $produit['NOMIMAGE'] ?>" alt="<?php echo $produit['NOMPRODUIT'] ?>">
                <div class="card-body">
                    <h5 class="card-title fs-4"><?php echo $produit['NOMPRODUIT'] ?></h5>
                    <p class="card-text m-2 fs-6"><?php echo $produit['DESCRIPTION'] ?></p>
                    <p class="card-text m-2 fs-5"><?php echo $produit['PRIX'] ?>€</p>
                    <a href="./index.php?page=detailProduit&idproduit=<?php echo $produit['IDPRODUIT'] ?>"
                        class="btn btn-primary"> Détail produit</a>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>
<?php if (isset($_SESSION['idClient'])){ ?>
<div class="d-grid gap-2 col-6 mx-auto mb-5">
    <a href="./index.php?page=panier"class="btn btn-primary mx-auto btn-lg mt-4"><i class="bi bi-cart"></i> Voir mon
        panier</a>
</div> <?php } ?>