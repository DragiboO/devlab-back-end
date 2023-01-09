<?php
session_start();

require_once './class/album.php';
require_once './class/connection.php';
require_once './class/user.php';



if (isset($_SESSION['user_id'])) {

    if (!isset($_GET['album'])) {
        header('Location: ../index.php');
    } else {
        if ($_GET['album'] === '') {
            header('Location: ../index.php');
        } else {
            $connection = new Connection();
            $albumExist = $connection->albumExist($_GET['album']);

            if ($albumExist) {
                $getAlbum = $connection->queryAlbum($_GET['album'], 4);
                var_dump($getAlbum);

                if ($getAlbum->ownerId !== $_SESSION['user_id']) {

                    $connection->like($_SESSION['user_id'], $_GET['album']);

                    header('Location: view-album.php?id=' . $_GET['album']);

                } else {
                    header('Location: ../index.php');
                }
            } else {
                header('Location: ../index.php');
            }
        }
    }
} else {
    header('Location: ../index.php');
}
