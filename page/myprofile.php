<?php
require "header.php";
?>

<head>
    <title>Mon Profil</title>
</head>

<?php
if (isset($_SESSION['user_id'])) {} else {
    header('Location: login.php');
}

?>



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

<main>
    <div class="flex justify-between px-40 py-8">
        <div>

        </div>
        <div>
            <a href="../page/disconnect.php" class="text-xl">Se déconnecter</a>
        </div>
    </div>

    <h2 class="px-40 py-8 text-2xl">Mes listes</h2>

    <form method="POST" class="px-40 py-8 text-2xl">
        <input type="text" name="album_name" placeholder="nom de la liste" class="text-black">
        <select name="visibility" class="text-black">
            <option value="1" class="text-black">Public</option>
            <option value="0" class="text-black">Privé</option>
        </select>
        <input type="submit" value="Créer" name="create" class="border-2 border-amber-50">
    </form>

    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        $connection->queryAlbum($_SESSION['user_id'], 1);
        $connection->queryAlbum($_SESSION['user_id'], 2);
        $connection->queryAlbum($_SESSION['user_id'], 0);

        ?>
    </div>
</main>
<?php require "footer.php"?>
</body>
</html>