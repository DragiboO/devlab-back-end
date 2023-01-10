<?php
session_start();

require_once './class/album.php';
require_once './class/connection.php';
require_once './class/user.php';

if (isset($_SESSION['user_id'])) {

    if (isset($_GET['album']) && isset($_GET['title'])) {

        if (isset($_GET['album']) != '' && isset($_GET['title']) !='') {

            $connection = new Connection();
            if ($connection->authorizedUser($_SESSION['user_id'], $_GET['album'])) {

                $connection->deleteTitle($_GET['album'], $_GET['title']);

                header('Location: /page/view-album.php?id=' . $_GET['album']);

            } else {
                header('Location: ../index.php');
            }
        } else {
            header('Location: ../index.php');
        }
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}

