<?php
require_once './class/movie.php';
require_once './class/connection.php';
require_once './class/user.php';

if (!isset($_GET['id'])) {
    header('Location: ../index.php');
}

$id = $_GET['id'];

if (isset($_GET['add'])) {
    $add = $_GET['add'];
}

$movie = new Movie();
$data = $movie->getMovie($id);

if ($data === null) {
    header('Location: ../index.php');
}
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

<main>
    <div class="menu_add absolute w-full h-full z-50 flex items-center justify-center hidden">
        <div class="sub_menu_add no_scroll_bar bg-black/75 w-[95%] h-[90%] rounded-3xl mt-[15vh] overflow-y-scroll p-10 flex flex-col xl:flex-row  gap-x-4">

            <?php

            if (isset($_SESSION["user_id"])) {

                echo '<div class="w-full xl:w-1/3">';
                    echo '<h2 class="text-sm sm:text-lg lg:text-xl xl:text-2xl">Liste par defaut</h2>';
                    echo '<hr class="mb-8">';

                    $connection = new Connection();

                    $arrayL = $connection->queryAlbum($_SESSION['user_id'], 1);

                    foreach ($arrayL as $list) {

                        $check = $connection->checkIfInAlbum($list->id, $_GET['id']);

                        echo '
                        <div class="p-2 bg-orange-500 w-full flex items-center justify-between mb-4 rounded">
                            <a href="view-album.php?id=' . $list->id . '"><h2 class="text-xs sm:text-sm lg:text-lg xl:text-xl">'. $list->name .'</h2></a>';

                            if ($check) {
                                echo '<a href="../page/onepage-movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                            } else {
                                echo '<p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-gray-700 rounded-lg">D??j?? dans la liste</p>';
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
                            <a href="view-album.php?id=' . $list->id . '"><h2 class="text-xs sm:text-sm lg:-text-lg xl:text-xl">'. $list->name .'</h2></a>';

                            if ($check) {
                                echo '<a href="../page/onepage-movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                            } else {
                                echo '<p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-gray-700 rounded-lg">D??j?? dans la liste</p>';
                            }

                        echo '
                        </div>
                        ';
                    }

                echo '</div>';


                echo '<div class="w-full xl:w-1/3">';
                    echo '<h2 class="text-sm sm:text-lg lg:text-xl xl:text-2xl">Mes listes</h2>';
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
                                <a href="view-album.php?id=' . $list->id . '"><h2 class="text-xs :sm:text-sm lg:text-lg xl:text-xl">'. $list->name .'</h2></a>';

                                if ($check) {
                                    echo '<a href="../page/onepage-movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-xs :sm:text-sm lg:text-lg xl:text-xl text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                                } else {
                                    echo '<p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-gray-700 rounded-lg">D??j?? dans la liste</p>';
                                }

                            echo '
                            </div>
                            ';
                        }
                    }

                echo '</div>';


                echo '<div class="w-full xl:w-1/3">';
                    echo '<h2 class="text-sm sm:text-lg lg:text-xl xl:text-2xl">Listes partag??s avec vous</h2>';
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
                                <a href="view-album.php?id=' . $list->id . '"><h2 class="text-xs :sm:text-sm lg:text-lg xl:text-xl">'. $list->name .' de ' . $list->pseudo . '</h2></a>';

                                if ($check) {
                                    echo '<a href="../page/onepage-movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>';
                                } else {
                                    echo '<p class="text-center text-xs :sm:text-sm lg:text-lg xl:text-xl px-2 py-1 bg-gray-700 rounded-lg">D??j?? dans la liste</p>';
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
                <img src="https://image.tmdb.org/t/p/original<?php echo $data["backdrop_path"]?>" alt="affiche_du_film" class="h-[30vh] sm:h-[45vh] lg:h-[65vh] xl:h-[70vh] w-full object-cover blur-sm relative">
                <div class="background-onepage-moovie absolute h-[30vh] sm:h-[45vh] lg:h-[65vh] xl:h-[72vh] w-full top-[8%] xl:top-[10%] left-0"></div>
                <img src="https://image.tmdb.org/t/p/original<?php echo$data["poster_path"]?>" alt="affiche_du_film" class="h-[30vh] sm:h-[45vh] lg:h-[65vh] bottom-[62%] left-[28%] xl:h-[60vh] absolute sm:bottom-[47%] sm:left-[35%] lg:left-[35%] lg:bottom-[26%] xl:bottom-[10%] xl:left-[15%]">
                <h2 class="static py-4 text-center xl:absolute xl:top-[74%] xl:left-[37%] text-base sm:text-lg lg:text-xl xl:text-3xl"><?php echo $data["title"]?></h2>
            </div>
            <div class="grid-cols-1 pl-10 text-xs sm:text-sm mt-2 lg:text-lg xl:text-xl xl:mt-10 grid sm:px-64 lg:grid-cols-3 lg:px-10 lg:gap-x-4 xl:grid-cols-3 xl:pl-24">
                <div class="mb-4 xl:mt-14 xl:ml-36 text-sm lg:text-lg xl:xl:text-xl">
                    <h2 class="add_btn cursor-pointer">Ajouter ?? une liste</h2>
                </div>
                <div class="flex gap-y-4 flex-col">
                    <h2>Titre original : <?php echo $data["original_title"]?></h2>
                    <h2>Score : <?php echo $data["vote_average"]?></h2>
                    <h2>Dur??e : <?php echo $data["runtime"]?>min</h2>
                    <h2>Genres :
                        <?php
                        $genres = $data["genres"];
                        foreach ($genres as $genre) {
                            echo '??? ' . $genre["name"] . ' ';
                        }
                        ?>
                    </h2>
                </div>
                <div class="flex gap-y-4 flex-col">
                    <h2>Pays d'origine :
                        <?php
                        $production_countries = $data["production_countries"];
                        foreach ($production_countries as $production_countrie) {
                            echo '??? ' . $production_countrie["name"] . ' ';
                        }
                        ?>
                    </h2>
                    <h2>Date de sortie :  <?php echo $data["release_date"]?></h2>
                    <h2>Revenue :  <?php echo $data["revenue"]?>$</h2>
                    <h2>Co??t de production :  <?php echo $data["budget"]?>$</h2>
                </div>
            </div>
            <div class="text-xs sm:text-sm lg:text-lg mt-2 xl:text-xl xl:mt-10 px-10 mt-2 sm:px-14 sm:mt-4 xl:px-40 mb-10">
                <div>
                    <h2>R??sum?? :</h2>
                    <h2 class="text-justify mt-4"> <?php echo $data["overview"]?></h2>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require "footer.php";?>
<script src="../assets/js/onepage-movie.js"></script>
</body>
</html>