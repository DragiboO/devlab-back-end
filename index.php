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
    <nav class="flex justify-between py-6 px-10 text-lg relative">
        <div class="flex items-center gap-x-10">
            <img src="assets/image/crunchyroule.png" alt="logo" class="w-12">
            <button class="hover">Naviguer</button>
        </div>
        <div class="flex items-center gap-x-10">
            <img src="assets/image/loupeblanche.png" alt="loupe" class="w-10">
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<a href="page/profile.php?id=' . $_SESSION['user_id'] . '">Mon profil</a>';
            } else {
                echo '<a href="page/login.php">Se connecter / s\'inscrire</a>';
            }
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

    <main class="ailleurs">

        <div class="background-moovie flex flex-col justify-end items-center">
            <div></div>
            <div></div>
            <div class="flex flex-col gap-y-2 text-center text-2xl">
                <h2>20th Century Girl</h2>
                <button class="bg-orange-500 p-1.5 rounded">Lecture</button>
                <button class="bg-orange-500 p-1.5 rounded">Plus d'info</button>
            </div>
        </div>

        <h2 class="text-2xl pt-6 pb-0 px-40">Most Popular</h2>

        <hr class="h-1 border-none bg-gray-700 mx-40 mt-6">

        <div class="grid grid-cols-4 gap-x-14 p-40 text-center gap-y-14 pt-10 pb-10 afficher">
            
        </div>

        <h2 class="text-2xl pb-6 pt-0 px-40">See all moovies ></h2>

    </main>

    <footer>
        <div>
            <hr class="h-px border-none bg-gray-700 mx-40">
            <div class="my-6 mx-40 flex justify-between">
                <p>© - Théa Blachon / Julien Grenouilleau</p>
                <a href="https://github.com/DragiboO/devlab-back-end" class="hover:text-orange-500">Github</a>
            </div>
        </div>
    </footer>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/api.js"></script>
</body>
</html>