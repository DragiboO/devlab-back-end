<?php
session_start();

require_once 'class/user.php';
require_once 'class/connection.php';
require_once 'class/album.php';
require_once 'class/movie.php';
require_once 'class/invitation.php';

if (isset($_SESSION['user_id'])) {
    if (isset($_GET['album']) && isset($_GET['user']) && isset($_GET['accept'])) {

        $connection = new Connection();
        $doInviteExist =  $connection->isAlreadyInvited($_GET['album'], $_GET['user']);

        var_dump($doInviteExist);

        if ($doInviteExist) {

            if ($_GET['user'] == $_SESSION['user_id']) {

                $connection = new Connection();
                $connection->removeRequest($_GET['album'], $_GET['user']);

                if ($_GET['accept'] === '1') {

                    $connection->addUserAlbum($_GET['album'], $_GET['user']);

                }
                header('Location: ../page/profile.php?id=' . $_SESSION['user_id']);

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
