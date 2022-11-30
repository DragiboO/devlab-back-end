<?php

    require_once 'class/connection.php';

    $email = $_GET['email'];
    $token = $_GET['token'];

    $connection = new Connection();
    $connection->validate($email,$token);

    header('Location: login.php');