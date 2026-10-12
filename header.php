<?php
$tmpPath = __DIR__ . '/tmp';
if (is_dir($tmpPath)) {
    session_save_path($tmpPath);
}
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icone2.png">
    <title>Tasty Manga</title>
    <link rel="stylesheet" href="mesStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container-fluid">
        <nav class="bg-dark bg-gradient opacity-75 text-white p-3 d-flex justify-content-around min-vw-98">
            <p class="navbar-brand fs-3">Tasty Manga</p>
            <a class="navbar-brand fs-3" href="./index.php?page=acceuil">Accueil</a>
            <a class="navbar-brand fs-3" href="./index.php?page=produit">Produit</a>
            <?php
            if (!isset($_SESSION['user']) && !isset($_SESSION['client'])) { ?>
                <a class="navbar-brand fs-3" href="./index.php?page=connexion&erreur=3">Admin</a>
                <a class="navbar-brand fs-3" href="./index.php?page=connexionClient"><i class="bi bi-box-arrow-in-right"></i> Connexion</a>



            <?php } else if (!isset($_SESSION['client'])) { ?>
                <a class="navbar-brand fs-3" href="./index.php?page=admin">Admin</a>
                <a class="navbar-brand fs-3" href="./connexion_exe.php?deco=true"><i class="bi bi-box-arrow-in-right"></i>
                    Déconnexion</a>



            <?php } else if (!isset($_SESSION['user'])) { ?>
                <a class="navbar-brand fs-3" href="./index.php?page=connexion&erreur=3">Admin</a>
                <p class="fs-5"><?php echo $_SESSION['client'] ?></p>
                <a class="navbar-brand fs-3" href="./index.php?page=panier"><i class="bi bi-basket"></i></a>
                <a class="navbar-brand fs-3" href="./index.php?page=commande"><i class="bi bi-clock-history"></i></i></a>
                <a class="navbar-brand fs-3" href="./connexionClient_exe.php?deco=true"><i class="bi bi-box-arrow-in-right"></i> Déconnexion</a>
            <?php }
            ?>


        </nav>