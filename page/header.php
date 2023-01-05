<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/main.css">
</head>

<body>
<div>
    <nav class="flex justify-between py-1 px-4 text-sm sm:py-2 sm:px-6 text-base xl:py-4 xl:px-10 xl:text-lg relative">
        <div class="flex items-center gap-x-1 sm:gap-x-4 xl:gap-x-10">
            <a href="../index.php"><img src="../assets/image/crunchyroule.png" alt="logo" class="w-6 sm:w-8 xl:w-12"></a>
            <ul id="menu-demo2">
                <li><a href="#" id="naviguer">Naviguer</a>
                    <ul>
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Aventure</a></li>
                        <li><a href="#">Animation</a></li>
                        <li><a href="#">Comedy</a></li>
                        <li><a href="#">Crime</a></li>
                        <li><a href="#">Documentaire</a></li>
                        <li><a href="#">Drama</a></li>
                        <li><a href="#">Famille</a></li>
                        <li><a href="#">Fantaisie</a></li>
                        <li><a href="#">Histoire</a></li>
                        <li><a href="#">Horreur</a></li>
                        <li><a href="#">Thriller</a></li>
                        <li><a href="#">Musique</a></li>
                        <li><a href="#">Mystère</a></li>
                        <li><a href="#">Romance</a></li>
                        <li><a href="#">Science Fiction</a></li>
                        <li><a href="#">Film TV</a></li>
                        <li><a href="#">Thriller</a></li>
                        <li><a href="#">Guerre</a></li>
                        <li><a href="#">Western</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-x-2 sm:gap-x-4 xl:gap-x-10">
            <a href="search.php"><img src="../assets/image/loupeblanche.png" alt="loupe" class="w-4 sm:w-6 xl:w-10"></a>
            <?php if(isset($_SESSION['user_id'])) {?>
                <a href="myprofile.php">Mon profil</a>
            <?php } else {?>
                <a href="page/login.php">Se connecter / s'inscrire</a>
            <?php }
            ?>
        </div>
    </nav>
</div>
