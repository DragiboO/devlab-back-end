<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/main.css">
    <title>My profile</title>
</head>
<body>

<?php
if (isset($_SESSION['user_id'])) {} else {
    header('Location: login.php');
}

?>

<form method="POST">
    <input type="text" name="album_name" placeholder="nom de l'album" class="text-black">
    <select name="visibility" class="text-black">
        <option value="1" class="text-black">Public</option>
        <option value="0" class="text-black">Privé</option>
    </select>
    <input type="submit" value="Créer" name="create" class="border-2 border-amber-50">
</form>

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

<section class="base">

    <?php

    $connection = new Connection();

    $connection->queryAlbum($_SESSION['user_id'], 1);
    $connection->queryAlbum($_SESSION['user_id'], 2);

    ?>



</section>

<br>

<section class="all">

    <?php

    $connection = new Connection();

    $connection->queryAlbum($_SESSION['user_id'], 0);

    ?>

</section>

</body>
</html>