<?php
session_start();

require_once './class/album.php';
require_once './class/connection.php';
require_once './class/user.php';

if (isset($_SESSION['user_id'])) {
    $connection = new Connection();
    $ownerId = $connection->getOwner($_GET['album']);

    if ($ownerId === $_SESSION['user_id']) {

        if ($ownerId !== $_GET['user']) {

            $userExist = $connection->userExist($_GET['user']);

            if ($userExist) {

                $alreadyInvited = $connection->isAlreadyInvited($_GET['album'], $_GET['user']);

                if (!$alreadyInvited) {

                    $alreadyInAlbum = $connection->authorizedUser($_GET['user'], $_GET['album']);

                    if ($alreadyInAlbum) {
                        header('Location: /page/view-album.php?id=' . $_GET['album']);
                    } else {
                        $connection->createInvitation($_SESSION['user_id'], $_GET['album'], $_GET['user']);
                    }
                }
                header('Location: /page/view-album.php?id=' . $_GET['album']);
            } else {
                header('Location: ../index.php');
            }
        } else {
            header('Location: /page/view-album.php?id=' . $_GET['album']);
        }
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}