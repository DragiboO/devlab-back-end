<?php require "header.php";

?>

<head>
    <title>Mon Profile</title>
</head>

<main>

    <div class="flex flex-row text-xs gap-x-2 mx-2 mt-2 sm:text-sm sm:w-[50%] sm:mx-10 sm:gap-x-6 sm:mt-6 lg:text-lg lg:mx-14 lg:gap-x-10 lg:px-8 xl:gap-x-10 bg-black rounded-lg xl:mx-40 xl:w-[35%] p-4 xl:px-10">
        <h2>User1234 veut vous partager son album.</h2>
        <img src="../assets/image/accepter.png" alt="accepter" class="w-4">
        <img src="../assets/image/refuser.png" alt="refuser" class="w-4">
    </div>

    <div class="flex justify-between sm:px-14 xl:px-40 xl:py-8 px-10 py-6">
        <div>

        </div>
        <div>
            <form method="POST" action="disconnect.php">
                <button name="disconnect" type="submit" class="text-sm xl:text-xl border-b-2 border-orange-500">Se déconnecter</button>
            </form>
        </div>
    </div>

    <h2 class="px-10 py-2 text-xs sm:text-base sm:px-14 xl:px-40 xl:py-8 xl:text-xl">Mes albums</h2>
    <div class="grid grid-cols-1 gap-y-6 px-10 mb-6 sm:grid-cols-2 sm:px-14 sm:gap-y-8 sm:gap-x-8 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-10 xl:px-40 xl:mb-8 xl:gap-y-10">
        <div class="relative">
            <a href="album.php"><img src="../assets/image/test.webp" alt="test"></a>
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Watchlist</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Visionnés</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 1</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 2</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 3</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 4</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 5</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xs sm:text-base xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 6</h2>
        </div>
    </div>
</main>

<?php require "footer.php"?>
</body>
</html>