<?php require "header.php";

?>

<head>
    <title>Mon Profile</title>
</head>

<main>
    <form method="POST">
        <button name="disconnect" type="submit">Se déconnecter</button>
    </form>
</main>

<?php

require_once 'class/user.php';
require_once 'class/connection.php';
$connection = new Connection();

if(isset($_POST['disconnect'])){
    unset($_SESSION['user_id']);
    header('Location: ../index.php');
}

?>

<?php require "footer.php"?>
</body>
</html>