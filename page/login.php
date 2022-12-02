<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<main class="content h-[100vh] flex justify-start items-center flex-col gap-y-2">
    <div class="w-[500px] h-auto text-lg text-center mt-[15vh]">

        <form method="POST" class="flex flex-col items-center bg-orange-500 rounded-3xl p-10 gap-y-10 mb-4">
                <input type="pseudo" name="pseudo" placeholder="pseudo" class="rounded-lg p-2 text-black">
                <input type="password" name="password" placeholder="password" class="rounded-lg p-2 text-black">
                <input type="submit" value="Login" name="login">
            </form>
            <a href="register.php">Or Register</a>
    </div>
</main>

<?php

require_once './class/user.php';
require_once './class/connection.php';

if ($_POST) {
    $user = new User(
        '',
        $_POST['password'],
        '',
        $_POST['pseudo'],
    );

    $connection = new Connection();

    $result = $connection->connection($user);
}


?>

</body>
</html>