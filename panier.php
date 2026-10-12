<h1 class="text-center m-3">Panier <i class="bi bi-basket"></i></h1>

<?php
$idclient = $_SESSION['idClient'];
$requete_sql = "SELECT commande.numCommande as numCommande, `date`, produit.idProduit as idProduit, quantite, nomProduit, prix, (prix*quantite) AS total FROM commande INNER JOIN contenir ON commande.numCommande=contenir.numCommande INNER JOIN produit ON contenir.idProduit=produit.idProduit WHERE idClient='$idclient' AND idStatut='ENC'";
$reponse = $mon_pdo->query($requete_sql); // exécution
$commandes = $reponse->fetchall(); // récupère tous les résultats
if (count($commandes) > 0) {
$idproduit=0;
?>

<table class="table table-striped table-bordered w-50 mx-auto my-5">
    <thead class="table-dark">
        <th>Nom du produit</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Total</th>
        <th></th>        
    </thead>
    <?php
    foreach ($commandes as $commande) {
        $idproduit=$commande["idProduit"];
        ?>
        <tbody>
            <tr>
                <td><?php echo $commande['nomProduit'] ?></td>
                <td><?php echo $commande['prix'] ?></td>
                <td><?php echo $commande['quantite'] ?></td>
                <td><?php echo $commande['total'] ?></td>
                <td><a href="./index.php?page=gestionCommande_exe&action=supprimer&idproduit=<?php echo $commande['idProduit'] ?>&numCommande=<?php echo $commande['numCommande'] ?>"><i class="bi bi-x-square"></i></a></td>
            </tr>
        <?php }
        $requete_sql = "SELECT commande.numCommande as numCommande, SUM(prix*quantite) AS montantTotal FROM commande INNER JOIN contenir ON commande.numCommande=contenir.numCommande INNER JOIN produit ON contenir.idProduit=produit.idProduit WHERE idClient='$idclient' AND idStatut='ENC'";
        $reponse = $mon_pdo->query($requete_sql); // exécution
        $total = $reponse->fetch();
        ?>
    
    </tbody>
</table>
<div class="d-grid gap-2 col-6 mx-auto ">
<h3 class="mx-auto">Total Panier :  <?php echo $total['montantTotal'] ?> €</h3></div>
<div class="d-grid gap-2 col-6 mx-auto mb-5">
<a class="btn btn-primary mx-auto btn-lg mt-4" href="./index.php?page=gestionCommande_exe&action=valider&idproduit=<?php echo $commande['idProduit'] ?>&numCommande=<?php echo $total['numCommande'] ?>">Valider</a>

</div>
<?php } ?>
