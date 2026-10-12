<?php
if (isset($_GET["idproduit"])) {
    $idproduit = $_GET["idproduit"];
    $requete_sql = "SELECT * FROM produit WHERE idProduit='$idproduit'";
} else {
    header("location:./index.php?page=produit");
}
$reponse = $mon_pdo->query($requete_sql); // exécution
$produit = $reponse->fetch(); // récupère tous les résultats
?>


<div class="col text-center m-4 d-flex flex-row justify-content-evenly">
    <img style="height: 450px; object-fit: contain;" class="m-4" src="<?php echo $produit['NOMIMAGE'] ?>"
        alt="<?php echo $produit['NOMPRODUIT'] ?>">
    <div class="d-flex flex-column justify-content-evenly">
        <h3><?php echo $produit['NOMPRODUIT'] ?></h3>
        <div>
            <h5>Description</h5>
            <textarea class=" m-2 fs-6" rows="6" cols="50" disabled>
                <?php echo $produit['DESCRIPTION'] ?>
            </textarea>
        </div>
        <div>
            <h5>Prix</h5>
            <p class=" m-2 fs-6"><?php echo $produit['PRIX'] ?>€</p>
        </div>
        <form action="commande_exe.php?idproduit=<?php echo $idproduit?>" method="POST">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="0" min="0" name="quantite" required
                    max="<?php echo $produit['STOCK'] ?>">
                <label for="floatingInput">Quantité (<?php echo $produit['STOCK'] ?> en stock)</label>
            </div>
            <?php if (isset($_SESSION['idClient'])&& $produit['STOCK']>0){ ?>
            <button type="submit" class="btn btn-primary mx-auto btn-lg mt-4"><i class="bi bi-cart"></i> Ajouter à mon
                panier</button> <?php } ?>
        </form>
    </div>
</div>
</div>
</div>