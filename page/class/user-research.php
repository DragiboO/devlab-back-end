<?php
require_once 'album.php';
require_once 'connection.php';
require_once 'user.php';

$connection = new Connection();
$user = $connection->getUserString($_GET['user']);

echo $user;

