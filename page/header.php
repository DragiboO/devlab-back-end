<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/main.css">
</head>

<body>
<div>
    <nav class="flex justify-between py-6 px-10 text-lg relative">
        <div class="flex items-center gap-x-10">
            <a href="../index.php"><img src="../assets/image/crunchyroule.png" alt="logo" class="w-12"></a>
            <button class="hover">Naviguer</button>
        </div>
        <div class="flex items-center gap-x-10">
            <img src="../assets/image/loupeblanche.png" alt="loupe" class="w-10">
            <?php if(isset($_SESSION['user_id'])) {?>
                <a href="myprofile.php">Mon profil</a>
            <?php } else {?>
            <a href="login.php">Se connecter / s'inscrire</a>
            <?php }
            ?>
        </div>
    </nav>

    <ul class="grid grid-cols-4 gap-x-10 p-10 text-center gap-y-4 bg-neutral-900 add w-full absolute invisible">
        <li>Action</li>
        <li>Comédie</li>
        <li>Documentaires</li>
        <li>Drames</li>
        <li>Fantastique</li>
        <li>Horreur</li>
        <li>Indépendants</li>
        <li>Jeunesse et famille</li>
        <li>Policier</li>
        <li>Romance</li>
        <li>SF</li>
        <li>Thriller</li>
    </ul>
</div>
