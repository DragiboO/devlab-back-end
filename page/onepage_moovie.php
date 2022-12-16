<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OnePage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="onepage">
        <?php
            $id = $_GET['id'];
        ?>
    </div>

    <script>
        var url_onepage = "https://api.themoviedb.org/3/movie/<?php echo $id ?>?api_key=f213e718db2b8476f73cd84bb74f1963&language=fr-FR"
    </script>
    <script src="../assets/js/onepage.js"></script>
</body>
</html>