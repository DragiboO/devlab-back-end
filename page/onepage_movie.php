<?php
require_once './class/movie.php';
require_once './class/connection.php';
require_once './class/user.php';

$id = $_GET['id'];

if (isset($_GET['add'])) {
    $add = $_GET['add'];
}

$movie = new Movie();
$data = $movie->getMovie($id);
?>

<head>
    <title><?php echo $data["title"]?></title>
</head>
<?php require "header.php"; ?>

<?php

if (isset($_GET['add'])) {

    if (isset($_SESSION['user_id'])) {

        $connection = new Connection();
        $authorized = $connection->authorizedUser($_SESSION['user_id'], $_GET['add']);

        if ($authorized) {

            $check = $connection->checkIfInAlbum($_GET['add'], $_GET['id']);

            if ($check) {
                $connection->insertTitle($_GET['add'], $_GET['id']);
            }
        }
    }
}



?>

<main class="ailleurs">
    <div class="menu_add absolute w-full h-full z-50 flex items-center justify-center hidden">
        <div class="sub_menu_add no_scroll_bar bg-black/75 w-[95%] h-[90%] rounded-3xl mt-[15vh] overflow-y-scroll p-10 flex gap-x-4">

            <?php

            if (isset($_SESSION["user_id"])) {

                echo '<div class="w-1/3">';
                    echo '<h2 class="text-2xl">JSP</h2>';
                    echo '<hr class="mb-8">';

                    $connection = new Connection();

                    $arrayL = $connection->queryAlbum($_SESSION['user_id'], 1);

                    foreach ($arrayL as $list) {

                        $check = $connection->checkIfInAlbum($list->id, $_GET['id']);

                        echo '
                        <div class="p-2 bg-orange-500 w-full flex items-center justify-between mb-4 rounded">
                            <h2 class="text-xl">'. $list->name .'</h2>';

                            if ($check) {
                                echo '<a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                            } else {
                                echo '<p class="text-center px-2 py-1 bg-gray-700 rounded-lg">Déjà dans la liste</p>';
                            }

                        echo '
                        </div>
                        ';
                    }

                    $arrayL = $connection->queryAlbum($_SESSION['user_id'], 2);

                    foreach ($arrayL as $list) {

                        $check = $connection->checkIfInAlbum($list->id, $_GET['id']);

                        echo '
                        <div class="p-2 bg-orange-500 w-full flex items-center justify-between mb-4 rounded">
                            <h2 class="text-xl">'. $list->name .'</h2>';

                            if ($check) {
                                echo '<a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                            } else {
                                echo '<p class="text-center px-2 py-1 bg-gray-700 rounded-lg">Déjà dans la liste</p>';
                            }

                        echo '
                        </div>
                        ';
                    }

                echo '</div>';


                echo '<div class="w-1/3">';
                    echo '<h2 class="text-2xl">Mes listes</h2>';
                    echo '<hr class="mb-8">';

                    $connection = new Connection();

                    $arrayL = $connection->queryAlbum($_SESSION['user_id'], 0);

                    if ($arrayL === null) {
                        echo '';
                    } else {
                        foreach ($arrayL as $list) {
                            $check = $connection->checkIfInAlbum($list->id, $_GET['id']);

                            echo '
                            <div class="p-2 bg-orange-500 w-full flex items-center justify-between mb-4 rounded">
                                <h2 class="text-xl">'. $list->name .'</h2>';

                                if ($check) {
                                    echo '<a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                                } else {
                                    echo '<p class="text-center px-2 py-1 bg-gray-700 rounded-lg">Déjà dans la liste</p>';
                                }

                            echo '
                            </div>
                            ';
                        }
                    }

                echo '</div>';


                echo '<div class="w-1/3">';
                    echo '<h2 class="text-2xl">Listes partagés avec vous</h2>';
                    echo '<hr class="mb-8">';

                    $connection = new Connection();

                    $arrayL = $connection->queryAlbum($_SESSION['user_id'], 3);

                    if ($arrayL === null) {
                        echo '';
                    } else {

                        foreach ($arrayL as $list) {

                            $check = $connection->checkIfInAlbum($list->id, $_GET['id']);

                            echo '
                            <div class="p-2 bg-orange-500 w-full flex items-center justify-between mb-4 rounded">
                                <h2 class="text-xl">'. $list->name .' de ' . $list->pseudo . '</h2>';

                                if ($check) {
                                    echo '<a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                                } else {
                                    echo '<p class="text-center px-2 py-1 bg-gray-700 rounded-lg">Déjà dans la liste</p>';
                                }

                            echo '
                            </div>
                            ';
                        }
                    }

                echo '</div>';

            } else {

              echo '<a href="login.php" class="flex">
                        <p class="mx-10 p-2 rounded-lg">Se connecter / s\'inscrire pour ajouter ce titre a une liste</p>
                    </a>
                    ';
            }

            ?>

        </div>
    </div>
    <div class="onepage">

        <div>
            <div>
                <img src="https://image.tmdb.org/t/p/original<?php echo $data["backdrop_path"]?>" alt="affiche_du_film" class="h-[70vh] w-full object-cover blur-sm relative">
                <div class="background-onepage-moovie absolute h-[71vh] w-full top-[90px] left-0"></div>
                <img src="https://image.tmdb.org/t/p/original<?php echo$data["poster_path"]?>" alt="affiche_du_film" class="h-[60vh] absolute bottom-[10%] left-[13%]">
                <h2 class="absolute top-[74%] left-[39%] text-3xl"><?php echo $data["title"]?></h2>
            </div>
            <div class="mt-10 grid grid-cols-3 pl-[10em]">
                <div class="mt-[4.5rem] ml-24 text-xl">
                    <h2 class="add_btn cursor-pointer">Ajouter à une liste</h2>
                </div>
                <div class="flex gap-y-4 flex-col">
                    <h2>Titre original : <?php echo $data["original_title"]?></h2>
                    <h2>Score : <?php echo $data["vote_average"]?></h2>
                    <h2>Durée : <?php echo $data["runtime"]?>min</h2>
                    <h2>Genres :
                        <?php
                        $genres = $data["genres"];
                        foreach ($genres as $genre) {
                            echo '• ' . $genre["name"] . ' ';
                        }
                        ?>
                    </h2>
                </div>
                <div class="flex gap-y-4 flex-col">
                    <h2>Pays d'origine :
                        <?php
                        $production_countries = $data["production_countries"];
                        foreach ($production_countries as $production_countrie) {
                            echo '• ' . $production_countrie["name"] . ' ';
                        }
                        ?>
                    </h2>
                    <h2>Date de sortie :  <?php echo $data["release_date"]?></h2>
                    <h2>Revenue :  <?php echo $data["revenue"]?>$</h2>
                    <h2>Coût de production :  <?php echo $data["budget"]?>$</h2>
                </div>
            </div>
            <div class="mt-10 px-36 grid grid-cols-2 ml-[-26em] mb-10">
                <div></div>
                <div>
                    <h2>Résumé :</h2>
                    <h2 class="text-justify mt-4"> <?php echo $data["overview"]?></h2>
                </div>
            </div>
        </div>
    </div>
</main>



<footer>
    <?php require "footer.php";
    ?>
</footer>
<script src="../assets/js/one_page_movie.js"></script>
</body>
</html>