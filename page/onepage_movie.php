<?php require "header.php"; ?>
<head>
    <title>One page moovie</title>
</head>
<main class="ailleurs">
    <div class="onepage">
        <?php
            require_once './class/movie.php';
            $id = $_GET['id'];

            $movie = new Movie();
            $data = $movie->getMovie($id);
        ?>
        <div>
            <div>
                <img src="https://image.tmdb.org/t/p/original<?php echo $data["backdrop_path"]?>" alt="affiche_du_film" class="h-[70vh] w-full object-cover blur-sm relative">
                <div class="background-onepage-moovie absolute h-[71vh] w-full top-[90px] left-0"></div>
                <img src="https://image.tmdb.org/t/p/original<?php echo$data["poster_path"]?>" alt="affiche_du_film" class="h-[60vh] absolute bottom-[10%] left-[13%]">
                <h2 class="absolute top-[74%] left-[39%] text-3xl"><?php echo $data["title"]?></h2>
            </div>
            <div class="mt-10 grid grid-cols-3 pl-[10em]">
                <div class="mt-[4.5rem] ml-24 text-xl">
                    <h2>Ajouter à une liste</h2>
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
                    <h2>Revenue :  <?php echo $data["revenue"]?></h2>
                    <h2>Coût de production :  <?php echo $data["budget"]?></h2>
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
    <script src="../assets/js/script.js"></script>
</body>
</html>