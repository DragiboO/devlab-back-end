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

    <h2 class="mx-40 text-2xl">JSP</h2>
    <hr class="mx-40 mb-8">
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        $arrayL = $connection->queryAlbum($_SESSION['user_id'], 1);

        foreach ($arrayL as $list) {
            echo '
                    <a href="../page/view-album.php?id='. $list->id .'">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">'. $list->name .'</h2>
                        </div>
                    </a>
                    ';
        }

        $arrayL = $connection->queryAlbum($_SESSION['user_id'], 2);

        foreach ($arrayL as $list) {
            echo '
                    <a href="../page/view-album.php?id='. $list->id .'">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">'. $list->name .'</h2>
                        </div>
                    </a>
                    ';
        }

        ?>
    </div>
    <h2 class="mx-40 text-2xl">Mes listes</h2>
    <hr class="mx-40 mb-8">
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        $arrayL = $connection->queryAlbum($_SESSION['user_id'], 0);

        if ($arrayL === null) {
            echo '';
        } else {

            foreach ($arrayL as $list) {
                echo '
                    <a href="../page/view-album.php?id=' . $list->id . '">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . '</h2>
                        </div>
                    </a>
                    ';
            }
        }

        ?>
    </div>
    <h2 class="mx-40 text-2xl">Listes partagés avec vous</h2>
    <hr class="mx-40 mb-8">
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        ?>
    </div>
</main>
<?php require "footer.php"?>
</body>
</html>