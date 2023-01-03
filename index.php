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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/main.css">
</head>

<body>
<div>
    <nav class="flex justify-between py-4 px-10 text-lg relative">
        <div class="flex items-center gap-x-10">
            <img src="assets/image/crunchyroule.png" alt="logo" class="w-12">
            <ul id="menu-demo2">
                <li><a href="#">Naviguer</a>
                    <ul>
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Comédie</a></li>
                        <li><a href="#">Documentaires</a></li>
                        <li><a href="#">Drames</a></li>
                        <li><a href="#">Fantastique</a></li>
                        <li><a href="#">Horreur</a></li>
                        <li><a href="#">Indépendants</a></li>
                        <li><a href="#">Jeunesse et famille</a></li>
                        <li><a href="#">Policier</a></li>
                        <li><a href="#">Romance</a></li>
                        <li><a href="#">SF</a></li>
                        <li><a href="#">Thriller</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-x-10">
            <img src="assets/image/loupeblanche.png" alt="loupe" class="w-10">
            <?php if(isset($_SESSION['user_id'])) {?>
                <a href="page/myprofile.php">Mon profil</a>
            <?php } else {?>
                <a href="page/login.php">Se connecter / s'inscrire</a>
            <?php }
            ?>
        </div>
    </nav>
</div>
    <main>

        <div class="background-moovie flex flex-col justify-end items-center">
            <div></div>
            <div></div>
            <div class="flex flex-col gap-y-2 text-center text-2xl">
                <h2>Le Chat Potté 2</h2>
                <button class="bg-orange-500 p-1.5 rounded">Lecture</button>
                <button class="bg-orange-500 p-1.5 rounded">Plus d'info</button>
            </div>
        </div>

        <h2 class="text-xl pt-6 pb-0 px-40">Most Popular</h2>

        <hr class="h-px border-none bg-gray-700 mx-40 mt-6">

        <div class="grid grid-cols-4 gap-x-14 p-40 text-center gap-y-14 pt-10 pb-10 afficher mb-4">
            
        </div>

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
    <script src="assets/js/api.js"></script>
</body>
</html>