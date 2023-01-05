<?php require "header.php";

?>

<head>
    <title>Mon Profile</title>
</head>

<main>
    <div class="flex justify-between xl:px-40 xl:py-8 px-10 py-6">
        <div>

        </div>
        <div>
            <form method="POST" action="disconnect.php">
                <button name="disconnect" type="submit" class="text-sm xl:text-xl border-b-2 border-orange-500">Se déconnecter</button>
            </form>
        </div>
    </div>

    <h2 class="px-10 py-2 text-xs xl:px-40 xl:py-8 xl:text-2xl">Mes albums</h2>
    <div class="grid grid-cols-1 gap-y-6 px-10 mb-6 xl:grid-cols-4 xl:gap-x-10 xl:px-40 xl:mb-8 xl:gap-y-10">
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Watchlist</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Visionnés</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 1</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 2</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 3</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 4</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 5</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 6</h2>
        </div>
    </div>
</main>

<?php require "footer.php"?>
</body>
</html>