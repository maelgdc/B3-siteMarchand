<h1 class="text-center m-3">Bienvenue <?php echo $_SESSION['user'] ?> sur la page Admin <br> Vous êtes Connecté en tant que <?php echo $_SESSION['role'] ?> <i
                class="bi bi-hand-thumbs-up-fill"></i></h1>

<?php
$requete_sql = "SELECT * FROM users";
$reponse = $mon_pdo->query($requete_sql); // exécution
$resultat = $reponse->fetchall(); // récupère tous les résultats
?>

<table class="table table-striped table-bordered w-50 mx-auto my-5">
    <thead class="table-dark">
        <th>Login</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Role</th>
    </thead>
    <?php
    foreach ($resultat as $user){
    ?>
    <tbody>
        <tr>
            <td><?php echo $user['login'] ?></td>
            <td><?php echo $user['nom'] ?></td>
            <td><?php echo $user['prenom'] ?></td>
            <td><?php echo $user['role'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>