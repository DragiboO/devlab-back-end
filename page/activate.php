<?php

    require_once 'class/connection.php';

    if (isset($_GET['email']) && isset($_GET['token'])) {

        $email = $_GET['email'];
        $token = $_GET['token'];

        $connection = new Connection();

        $result = $connection->uniqueMail($email);

        if ($result) {

            $result = $connection->tokenExist($token);

            if ($result) {

                $connection->validate($email,$token);
                echo 'Activation du compte réussi';
                header('refresh:3;url=login.php');
            } else {
                echo "Prolème d'activation token";
                header('refresh:2;url=register.php');
            }
        } else {
            echo "Prolème d'activation email";
            header('refresh:2;url=register.php');
        }
    } else {
        echo 'no get';
        header('refresh:1;url=index.php');
    }

