<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/main.css">
</head>

<body>
<div>
    <nav class="flex justify-between py-1 px-4 text-sm sm:py-2 sm:px-8 text-base xl:py-4 xl:px-10 xl:text-lg relative">
        <div class="flex items-center gap-x-1 sm:gap-x-4 xl:gap-x-10">
            <a href="../index.php"><img src="assets/image/crunchyroule.png" alt="logo" class="w-14 sm:w-10 xl:w-12"></a>
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
        <div class="flex items-center gap-x-4 gap-x-1 gap-y-2 sm:gap-x-4 xl:gap-x-10">
            <a href="page/search.php"><img src="assets/image/loupeblanche.png" alt="loupe" class="w-4 sm:w-6 xl:w-10"></a>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<a href="page/profile.php?id=' . $_SESSION['user_id'] . '" class="text-xs xl:text-xl">Mon profil</a>';
            } else {
                echo '<a href="page/login.php" class="text-xs xl:text-xl">Se connecter / s\'inscrire</a>';
            }
            ?>
        </div>
    </nav>
</div>
    <main>

        <div class="background-moovie flex flex-col justify-end items-center">
            <div></div>
            <div></div>
            <div class="flex flex-col gap-y-2 text-center sm:text-xl text-base xl:text-2xl">
                <h2>Le Chat Potté 2</h2>
                <button class="text-xs sm:text-sm bg-orange-500 p-1.5 rounded">Lecture</button>
                <button class="text-xs sm:text-sm bg-orange-500 p-1.5 rounded">Plus d'info</button>
            </div>
        </div>

        <h2 class="text-sm pt-4 px-10 mb-2 sm:text-base lg:mb-4 xl:text-xl xl:pt-6 pb-0 xl:px-40">Most Popular</h2>

        <hr class="h-px border-none bg-gray-700 mx-10 xl:mx-40 mt-0 xl:mt-6">

        <div class="grid grid-cols-1 gap-x-6 p-10 gap-y-10 pt-4 sm:grid-cols-2 sm:gap-x-10 sm:gap-y-12 lg:grid-cols-3 lg:gap-x-12 lg:gap-y-12 xl:grid-cols-4 xl:gap-x-14 xl:p-40 text-center xl:gap-y-14 xl:pt-10 xl:pb-10 afficher mb-4">
            
        </div>

    </main>

    <footer>
        <div>
            <hr class="h-px border-none bg-gray-700 mx-10 xl:mx-40">
            <div class="text-xs xl:text-xl my-2 mx-10 xl:my-6 xl:mx-40 flex justify-between">
                <p>© - Théa Blachon / Julien Grenouilleau</p>
                <a href="https://github.com/DragiboO/devlab-back-end" class="hover:text-orange-500">Github</a>
            </div>
        </div>
    </footer>
    <script src="assets/js/api.js"></script>
</body>
</html>