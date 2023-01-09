<?php require_once 'header.php';?>
<head>
    <title>Login</title>
</head>

<main class="content h-[90vh] flex justify-center items-center flex-col gap-y-2">
    <div class="w-[500px] h-auto text-lg text-center">

        <form method="POST" class="flex flex-col items-center bg-orange-500 rounded-3xl p-10 gap-y-10 mb-4">
                <input type="pseudo" name="pseudo" placeholder="pseudo" class="rounded-lg p-2 text-black">
                <input type="password" name="password" placeholder="password" class="rounded-lg p-2 text-black">
                <input type="submit" value="Login" name="login">
            </form>
            <a href="register.php">Or Register</a>
    </div>
    <p class="h-4">
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

        echo $result;
    }
    ?>
    </p>
</main>


<?php require "footer.php";?>


</body>
</html>