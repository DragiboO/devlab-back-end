<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="flex justify-between p-6 text-lg">
        <div class="flex items-center gap-x-10">
            <img src="../assets/image/crunchyroule.png" alt="logo" class="w-12">
            <h2>Naviguer</h2>
        </div>
        <div class="flex items-center gap-x-10">
            <img src="../assets/image/loupeblanche.png" alt="loupe" class="w-10">
            <h2>Se connecter / s'inscrire</h2>
        </div>
    </nav>

    <div class="background-moovie flex flex-col justify-end items-center">
        <div></div>
        <div></div>
        <div class="flex flex-col gap-y-2 text-center text-2xl">
            <h2>Arknights</h2>
            <button class="bg-orange-500 p-1.5 rounded">Lecture</button>
            <button class="bg-orange-500 p-1.5 rounded">Plus d'info</button>
        </div>
    </div>

    <h2 class="text-center text-2xl pt-6">Most Popular</h2>

    <div class="grid grid-cols-4 gap-x-10 p-10 text-center">
        <div class="bg-orange-500 rounded-3xl">
            <img src="../assets/image/tensura.jpg" alt="" class="rounded-t-2xl">
            <h2 class="p-2 text-xl">Title</h2>
            <p class="text-lg">like</p>
        </div>
        <div class="bg-orange-500 rounded-3xl">
            <img src="../assets/image/tensura.jpg" alt="" class="rounded-t-2xl">
            <h2 class="p-2 text-xl">Title</h2>
            <p>like</p>
        </div>
        <div class="bg-orange-500 rounded-3xl">
            <img src="../assets/image/tensura.jpg" alt="" class="rounded-t-2xl">
            <h2 class="p-2 text-xl">Title</h2>
            <p>like</p>
        </div>
        <div class="bg-orange-500 rounded-3xl">
            <img src="../assets/image/tensura.jpg" alt="" class="rounded-t-2xl">
            <h2 class="p-2 text-xl">Title</h2>
            <p>like</p>
        </div>
    </div>
</body>
</html>