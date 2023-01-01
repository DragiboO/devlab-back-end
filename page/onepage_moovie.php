<?php require "header.php"; ?>
<head>
    <title>One page moovie</title>
</head>
<main class="ailleurs">
    <div class="onepage">
        <?php
            $id = $_GET['id'];
        ?>
    </div>

    <script>
        var url_onepage = "https://api.themoviedb.org/3/movie/<?php echo $id ?>?api_key=f213e718db2b8476f73cd84bb74f1963&language=fr-FR"
    </script>
</main>
<footer>
    <?php require "footer.php"; ?>
</footer>
    <script src="../assets/js/onepage.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>