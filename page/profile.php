<?php
require_once './class/album.php';
require_once './class/connection.php';
require_once './class/user.php';

require "header.php";

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
} else {

    if ($_GET['id'] === '') {
        header('Location: ../index.php');
    }

    $connection = new Connection();
    $userExist = $connection->userExist($_GET['id']);

    if ($userExist) {
        $profileId = $_GET['id'];
        $profilePseudo = $connection->getPseudo($_GET['id']);
    } else {
        header('Location: ../index.php');
    }
}
?>

<head>
    <title>
        <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
            echo 'Profil de ' . $profilePseudo;
        } else {
            echo 'Mon profil';
        }
        ?>
    </title>
</head>

<?php

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

<main class="mb-10">

    <div class="flex flex-row text-xs gap-x-2 mx-2 mt-2 sm:text-sm sm:w-[50%] sm:mx-10 sm:gap-x-6 sm:mt-6 lg:text-lg lg:mx-14 lg:gap-x-10 lg:px-8 xl:gap-x-10 bg-black rounded-lg xl:mx-40 xl:w-[35%] p-4 xl:px-10">
        <h2>User1234 veut vous partager son album.</h2>
        <img src="../assets/image/accepter.png" alt="accepter" class="w-4">
        <img src="../assets/image/refuser.png" alt="refuser" class="w-4">
    </div>

    <?php
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] === $profileId) {
            echo '
        <div class="flex justify-end px-40 py-8">
            <div>
                <a href="disconnect.php" class="text-sm xl:text-xl border-b-2 border-orange-500">Se déconnecter</a>
            </div>
        </div>
        ';
        }
    }
    ?>

    <h2 class="px-40 py-8 text-3xl">
        <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
            echo 'Profil de ' . $profilePseudo;
        } else {
            echo 'Votre profil';
        }
        ?>
    </h2>

    <?php
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] === $profileId) {
                echo '
            <form method="POST" class="px-40 py-8 text-2xl">
                <input type="text" name="album_name" placeholder="nom de la liste" class="text-black py-1 pl-2">
                <select name="visibility" class="text-black">
                    <option value="1" class="text-black">Public</option>
                    <option value="0" class="text-black">Privé</option>
                </select>
                <input type="submit" value="Créer" name="create" class="border-2 border-amber-50">
            </form>
            ';
            }
        }
    ?>

    <hr class="mx-40 mb-8">
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        $arrayL = $connection->queryAlbum($profileId, 1);

        if ($arrayL !== null) {

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

        $arrayL = $connection->queryAlbum($profileId, 2);

        if ($arrayL !== null) {

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
    <h2 class="mx-40 text-2xl">
        <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
            echo 'Créations de ' . $profilePseudo;
        } else {
            echo 'Vos créations';
        }
        ?>
    </h2>
    <hr class="mx-40 mb-8">
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        $arrayL = $connection->queryAlbum($profileId, 0);

        if ($arrayL !== null) {

            foreach ($arrayL as $list) {
                if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
                    if ($list->isPublic === '1') {
                        echo '
                        <a href="../page/view-album.php?id=' . $list->id . '">
                            <div class="relative">
                                <img src="../assets/image/test.webp" alt="test">
                                <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . '</h2>
                            </div>
                        </a>
                        ';
                    }
                } else {
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
        }

        ?>
    </div>
    <h2 class="mx-40 text-2xl">
        <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
            echo 'Listes partagés avec ' . $profilePseudo;
        } else {
            echo 'Listes partagés avec vous';
        }
        ?>
    </h2>
    <hr class="mx-40 mb-8">
    <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
        <?php

        $connection = new Connection();

        $arrayL = $connection->queryAlbum($profileId, 3);

        if ($arrayL !== null) {

            foreach ($arrayL as $list) {
                if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
                    if ($list->isPublic === '1') {
                        echo '
                        <a href="../page/view-album.php?id=' . $list->id . '">
                            <div class="relative">
                                <img src="../assets/image/test.webp" alt="test">
                                <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . ' de ' . $list->pseudo .'</h2>
                            </div>
                        </a>
                        ';
                    }
                } else {
                    echo '
                    <a href="../page/view-album.php?id=' . $list->id . '">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . ' de ' . $list->pseudo .'</h2>
                        </div>
                    </a>
                    ';
                }
            }
        }

        ?>
    </div>
</main>
<?php require "footer.php"?>
</body>
</html>