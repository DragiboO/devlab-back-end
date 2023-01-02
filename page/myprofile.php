<?php
require "header.php";
?>

<head>
    <title>Mon Profile</title>
</head>

<?php
if (isset($_SESSION['user_id'])) {} else {
    header('Location: login.php');
}

?>

<form method="POST">
    <input type="text" name="album_name" placeholder="nom de l'album" class="text-black">
    <select name="visibility" class="text-black">
        <option value="1" class="text-black">Public</option>
        <option value="0" class="text-black">Privé</option>
    </select>
    <input type="submit" value="Créer" name="create" class="border-2 border-amber-50">
</form>

<?php
require_once './class/album.php';
require_once './class/connection.php';
require_once './class/user.php';


if ($_POST) {

    $album = new Album(
        $_POST['album_name'],
        $_POST['visibility'],
        0,
        0,
        $_SESSION['user_id']
    );

    $connection = new Connection();
    $connection->createAlbum($album);

    $connection->addOwnerLastAlbum($_SESSION['user_id']);
}

?>

<section class="base">

    <?php

    $connection = new Connection();

    $connection->queryAlbum($_SESSION['user_id'], 1);
    $connection->queryAlbum($_SESSION['user_id'], 2);

    ?>



</section>

<br>

<section class="all">

    <?php

    $connection = new Connection();

    $connection->queryAlbum($_SESSION['user_id'], 0);

    ?>

</section>

<main>
    <div class="flex justify-between px-40 py-8">
        <div>

        </div>
        <div>
            <form method="POST">
                <button name="disconnect" type="submit" class="text-xl">Se déconnecter</button>
            </form>
        </div>
    </div>

    <h2 class="px-40 py-8 text-2xl">Mes albums</h2>
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Watchlist</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Visionnés</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 1</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 2</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 3</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 4</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 5</h2>
        </div>
        <div class="relative">
            <img src="../assets/image/test.webp" alt="test">
            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">Album 6</h2>
        </div>
    </div>
</main>

<?php

require_once 'class/user.php';
require_once 'class/connection.php';
$connection = new Connection();

if(isset($_POST['disconnect'])){
    unset($_SESSION['user_id']);
    header('Location: ../index.php');
}

?>

<?php require "footer.php"?>
</body>
</html>