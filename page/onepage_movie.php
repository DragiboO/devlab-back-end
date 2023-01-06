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

<main class="ailleurs">
    <div class="menu_add absolute w-full h-full z-50 flex items-center justify-center hidden">
        <div class="sub_menu_add no_scroll_bar bg-black/75 w-[95%] h-[90%] rounded-3xl mt-[15vh] overflow-y-scroll py-10">

            <h2 class="mx-40 text-2xl">JSP</h2>
            <hr class="mx-40 mb-8">
            <div class="grid grid-cols-4 gap-x-10 px-40 mb-8 gap-y-10">
                <?php

                $connection = new Connection();

                $arrayL = $connection->queryAlbum($_SESSION['user_id'], 1);

                foreach ($arrayL as $list) {
                    echo '
                    <div class="relative">
                        <a href="../page/view-album.php?id='. $list->id .'">
                            <img src="../assets/image/test.webp" alt="test">
                        </a>
                        <div class="p-2 absolute left-0 bottom-0 bg-orange-500 w-full flex items-center justify-between">
                            <h2 class="text-xl">'. $list->name .'</h2>
                            <a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>
                        </div>
                    </div>
                    ';
                }

                $arrayL = $connection->queryAlbum($_SESSION['user_id'], 2);

                foreach ($arrayL as $list) {
                    echo '
                    <div class="relative">
                        <a href="../page/view-album.php?id='. $list->id .'">
                            <img src="../assets/image/test.webp" alt="test">
                        </a>
                        <div class="p-2 absolute left-0 bottom-0 bg-orange-500 w-full flex items-center justify-between">
                            <h2 class="text-xl">'. $list->name .'</h2>
                            <a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>
                        </div>
                    </div>
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

                foreach ($arrayL as $list) {
                    echo '
                    <div class="relative">
                        <a href="../page/view-album.php?id='. $list->id .'">
                            <img src="../assets/image/test.webp" alt="test">
                        </a>
                        <div class="p-2 absolute left-0 bottom-0 bg-orange-500 w-full flex items-center justify-between">
                            <h2 class="text-xl">'. $list->name .'</h2>
                            <a href="../page/onepage_movie.php?id='. $_GET['id'] .'&add='. $list->id . '"><p class="text-center px-2 py-1 bg-orange-600 rounded-lg">Ajouter</p></a>
                        </div>
                    </div>
                    ';
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