<h1 class="text-center m-3">Historique des Commandes </h1>

<?php
$idclient = $_SESSION['idClient'];
$requete_sql = "SELECT commande.numCommande as numCommande, `date`, statut.libelleStatut as statut ,  SUM(prix*quantite) AS montantTotal, SUM(quantite) as nb_articles FROM commande INNER JOIN contenir ON commande.numCommande=contenir.numCommande INNER JOIN statut ON commande.idStatut=statut.idStatut INNER JOIN produit ON contenir.idProduit=produit.idProduit WHERE idClient='$idclient' GROUP BY commande.numCommande ORDER BY `date` DESC, commande.numCommande DESC ";
$reponse = $mon_pdo->query($requete_sql); // exécution
$commandes = $reponse->fetchall(); // récupère tous les résultats
?>

<table class="table table-striped table-bordered w-50 mx-auto my-5">
    <thead class="table-dark">
        <th>Numéro de commande</th>
        <th>Date</th>
        <th>Nombre d'articles</th>
        <th>Statut</th>
        <th>Montant</th>        
    </thead>
    <?php
    foreach ($commandes as $commande) {
        ?>
        <tbody>
            <tr>
                <td><?php echo $commande['numCommande'] ?></td>
                <td><?php echo $commande['date'] ?></td>
                <td><?php echo $commande['nb_articles'] ?></td>
                <td><?php echo $commande['statut'] ?></td>
                <td><?php echo $commande['montantTotal'] ?> €</td>
            </tr>
        <?php }
        $requete_sql = "SELECT commande.numCommande as numCommande, SUM(prix*quantite) AS montantTotal FROM commande INNER JOIN contenir ON commande.numCommande=contenir.numCommande INNER JOIN produit ON contenir.idProduit=produit.idProduit WHERE idClient='$idclient' AND idStatut='ENC'";
        $reponse = $mon_pdo->query($requete_sql); // exécution
        $total = $reponse->fetch();
        ?>
    
    </tbody>
</table>
