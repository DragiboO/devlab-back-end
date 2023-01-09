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

    <?php
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] === $profileId) {

            $connection = new Connection();
            $invitationRequest = $connection->getInvitationRequest($_SESSION['user_id']);

            if ($invitationRequest !== null) {

                foreach ($invitationRequest as $request) {

                    echo '
                    <div class="flex flex-row justify-between items-center gap-x-10 text-xs mx-2 mt-2 sm:text-sm sm:w-[75%] lg:w-[60%] xl:w-[40%] sm:mx-10 sm:mt-6 lg:text-lg lg:mx-14 lg:px-8 bg-black rounded-lg xl:mx-40 p-4 xl:px-10">
                        <h2>' . $request->pseudo . ' veut vous partager son album : ' . $request->name . '</h2>
                        <div class="flex gap-x-8">
                            <a href="/page/invitation-request.php?album=' . $request->albumId . '&user=' . $request->userIdRequest . '&accept=1">
                                <img src="../assets/image/accepter.png" alt="accepter" class="w-8 h-8">
                            </a>
                            <a href="/page/invitation-request.php?album=' . $request->albumId . '&user=' . $request->userIdRequest . '&accept=0">
                                <img src="../assets/image/refuser.png" alt="refuser" class="w-8 h-8">
                            </a>
                        </div>
                    </div>
                    ';
                }
            }
        }
    }
    ?>



    <?php
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] === $profileId) {
            echo '
            <div class="flex justify-end px-10 py-4 xl:px-40 xl:py-8">
                <div>
                    <a href="disconnect.php" class="text-sm xl:text-xl border-b-2 border-orange-500">Se déconnecter</a>
                </div>
            </div>
            ';
        }
    }
    ?>

    <h2 class="px-10 py-2 text-lg xl:px-40 xl:py-8 xl:text-3xl">
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
            <form method="POST" class="text-sm px-10 py-2 xl:px-40 xl:py-8 xl:text-2xl">
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

    <hr class="mx-10 mb-2 text-sm xl:mx-40 xl:text-2xl">
    <div class="grid grid-cols-1 gap-y-6 px-10 mb-6 sm:grid-cols-2 sm:px-14 sm:gap-y-8 sm:gap-x-8 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-10 xl:px-40 xl:mb-8 xl:gap-y-10">
        <?php

        $connection = new Connection();

        $arrayL = $connection->queryAlbum($profileId, 1);

        if ($arrayL !== null) {

            foreach ($arrayL as $list) {
                echo '
                    <a href="../page/view-album.php?id=' . $list->id . '">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xs sm:text-sm lg:text-lg xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . '</h2>
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
                            <h2 class="p-2 text-xs sm:text-sm lg:text-lg xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . '</h2>
                        </div>
                    </a>
                    ';
            }
        }

        ?>
    </div>
    <h2 class="mx-10 text-sm xl:mx-40 xl:text-2xl">
        <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
            echo 'Créations de ' . $profilePseudo;
        } else {
            echo 'Vos créations';
        }
        ?>
    </h2>
    <hr class="mx-10 mb-2 xl:mx-40 xl:mb-8">
    <div class="grid grid-cols-1 gap-y-6 px-10 mb-6 sm:grid-cols-2 sm:px-14 sm:gap-y-8 sm:gap-x-8 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-10 xl:px-40 xl:mb-8 xl:gap-y-10">
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
                                <h2 class="p-2 text-xs sm:text-sm lg:text-lg xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . '</h2>
                            </div>
                        </a>
                        ';
                    }
                } else {
                    echo '
                    <a href="../page/view-album.php?id=' . $list->id . '">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xs sm:text-sm lg:text-lg xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . '</h2>
                        </div>
                    </a>
                    ';
                }
            }
        }

        ?>
    </div>
    <h2 class="mx-10 text-sm xl:mx-40 xl:text-2xl">
        <?php
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $profileId) {
            echo 'Listes partagés avec ' . $profilePseudo;
        } else {
            echo 'Listes partagés avec vous';
        }
        ?>
    </h2>
    <hr class="mx-10 mb-2 text-sm xl:mx-40 xl:text-2xl">
    <div class="grid grid-cols-1 gap-y-6 px-10 mb-6 sm:grid-cols-2 sm:px-14 sm:gap-y-8 sm:gap-x-8 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-10 xl:px-40 xl:mb-8 xl:gap-y-10">
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
                                <h2 class="p-2 text-xs :sm:text-sm lg:text-lg xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . ' de ' . $list->pseudo .'</h2>
                            </div>
                        </a>
                        ';
                    }
                } else {
                    echo '
                    <a href="../page/view-album.php?id=' . $list->id . '">
                        <div class="relative">
                            <img src="../assets/image/test.webp" alt="test">
                            <h2 class="p-2 text-xs :sm:text-sm lg:text-lg xl:text-xl absolute left-0 bottom-0 bg-orange-500 w-full">' . $list->name . ' de ' . $list->pseudo .'</h2>
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