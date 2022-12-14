<?php
require_once './class/album.php';
require_once './class/connection.php';
require_once './class/user.php';

require "header.php";
?>
<main class="relative">
    <?php
    if (isset($_SESSION['user_id'])) {
        $connection = new Connection();
        $ownerId = $connection->getOwner($_GET['id']);

        if ($ownerId == $_SESSION['user_id']) {

            echo '<section class="menu_add_someone absolute h-full w-full flex hidden justify-center">
                    <div class="sub_menu_add_someone w-[90%] xl:w-full bg-black/75 xl:m-16 rounded-xl p-8 xl:p-16">
                        <div class="flex flex-col xl:justify-between">
                            <input class="input text-black px-2" onkeyup="find_user()" type="text" name="input" placeholder="Pseudo">
                            <button class="close_menu">Fermer le menu</button>
                        </div>
                        <div class="user_research w-full mt-4 flex flex-wrap items-center gap-x-2"></div>
                    </div>
                </section>
            ';

            echo '<script>var album_id_js = ' . $_GET['id'] . '</script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>';
            echo '<script defer src="../assets/js/view-album.js"></script>';
        }
    }
    ?>

    <div class="flex flex-col xl:flex-row px-10 xl:justify-between xl:items-center px-4 sm:px-10 lg:px-16 xl:px-24 my-10">
        <div class="flex flex-col xl:flex-row xl:items-center gap-x-10">
            <?php
            if (!isset($_GET['id'])) {
                header('Location: ../index.php');
            } else {

                if ($_GET['id'] === '') {
                    header('Location: ../index.php');
                }

                $connection = new Connection();
                $albumExist = $connection->albumExist($_GET['id']);

                if ($albumExist) {

                    $album = $connection->queryAlbum($_GET['id'] , 4);

                    if ($album->isPublic === '1') {

                        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $album->ownerId) {
                            echo  '<h2 class="xl:text-2xlxl: text-center xl:py-4">'. $album->name . ' de ' . $album->pseudo .'</h2>';
                        } else {
                            echo '<h2 class="xl:text-2xl xl:text-center xl:py-4">'. $album->name .'</h2>';
                        }
                    } else {

                        if (!isset($_SESSION['user_id'])) {
                            header('Location: ../index.php');
                        } else {

                            $authorized =$connection->authorizedUser($_SESSION['user_id'], $_GET['id']);

                            if ($authorized) {

                                if ($_SESSION['user_id'] != $album->ownerId) {
                                    echo  '<h2 class="xl:text-2xl text-center py-4">'. $album->name . ' de ' . $album->pseudo .'</h2>';
                                } else {
                                    echo '<h2 class="xl:text-2xl text-center py-4">'. $album->name .'</h2>';
                                }

                            } else {
                                header('Location: ../index.php');
                            }
                        }
                    }

                } else {
                    header('Location: ../index.php');
                }
            }



            $connection = new Connection();
            echo '<p>' . $connection->countLike($_GET['id']) . ' Likes</p>';

            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== $album->ownerId) {

                if ($connection->isLiked($_SESSION['user_id'], $_GET['id'])) {
                    echo '<a href="add-like.php?album=' . $_GET['id'] . '"><img src="../assets/image/heart.webp" alt="" class="w-8 h-8"></a>';
                } else {
                    echo '<a href="add-like.php?album=' . $_GET['id'] . '"><img src="../assets/image/empty-heart.webp" alt="" class="w-8 h-8"></a>';
                }
            }
            ?>

        </div>

        <div class="flex items-center gap-x-10">

            <?php
            if (isset($_SESSION['user_id'])) {
                $connection = new Connection();
                $ownerId = $connection->getOwner($_GET['id']);

                if ($ownerId == $_SESSION['user_id']) {
                    echo '<button class="btn_add_someone">Ajouter quelqu\'un</button>';
                }
            }
            ?>

        </div>
    </div>

    <div class="flex flex-row text-sm px-4 gap-x-14 pb-2 sm:text-lg sm:gap-x-24 sm:px-10 lg:px-16 lg:text-xl lg:gap-x-28 xl:text-xl xl:px-24 xl:gap-x-32 xl:pb-2 border-b-[1px] border-gray-700">
        <h2>Affiche</h2>
        <h2>Titre</h2>
        <h2>dur??e</h2>
    </div>

    <div class="flex flex-col mb-4 min-h-[60vh]">
    <?php

    $arrayTitle = ($connection->titleInAlbum($_GET['id']));

    if ($arrayTitle !== 'vide') {
        foreach ($arrayTitle as $title) {

            $movie = new Movie();
            $data = $movie->getMovie($title->id);

            echo '
        <div class="flex flex-row items-center gap-x-6 px-4 pb-2 mt-2 sm:px-10 lg:px-16 xl:gap-x-10 xl:px-24 border-b-[1px] border-gray-700 xl:pb-6 xl:mt-6">
            <a href="onepage-movie.php?id=' . $title->id . '"><img src="https://image.tmdb.org/t/p/original' . $data["poster_path"] .'" class="w-14"></a>
            <div class="flex flex-row gap-x-4 sm:gap-x-6 text-xs sm:text-sm lg:text-lg xl:gap-x-12 xl:text-lg">
                <a href="onepage-movie.php?id=' . $title->id . '"><h2>' . $data["title"] . '</h2></a>
                <h2>' . $data["runtime"].' min</h2>';

                if (isset($_SESSION['user_id'])) {
                    if ($connection->authorizedUser($_SESSION['user_id'], $_GET['id'])) {
                        echo '<a href="delete-title.php?title=' . $title->id . '&album=' . $_GET['id'] . '">Retirer de l\'album</a>';
                    }
                }

            echo '
            </div>
        </div>
        ';
        }
    }
    ?>

    </div>
</main>

<?php
require "footer.php";
?>
