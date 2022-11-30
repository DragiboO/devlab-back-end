<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <main class="content">
        <section class="w-[500px] h-auto text-lg divabsolute text-center">
            <form method="POST" class="flex flex-col items-center bg-orange-500 rounded-3xl p-10 gap-y-10 mb-4">

                <input type="email" name="email" placeholder="email" required class="rounded-lg p-2">
                <input type="password" name="password1" placeholder="password" required class="rounded-lg p-2 text-black">
                <input type="password" name="password2" placeholder="retype password" required class="rounded-lg p-2 text-black">
                <input type="text" name="pseudo" placeholder="pseudo" required class="rounded-lg p-2 text-black">

                <input type="submit" value="Register">
            </form>
        </section>

        <?php
        require_once './class/user.php';
        require_once './class/connection.php';

        if ($_POST) {
            $user = new User(
                $_POST['email'],
                $_POST['password1'],
                $_POST['password2'],
                $_POST['pseudo'],
            );

            $user->created_at = date("Y-m-d H:i:s");
            $user->token = bin2hex(openssl_random_pseudo_bytes(32));
            $user->validated = 0;

            if ($user->verify()) {
                // record to database
                $connection = new Connection();
                $result = $connection->insert($user);

                if ($result) {
                    echo '<h3 class="success">Registered with success 😎</h3>';
                    echo '<p class="timer"></p>';

                    $message = "Hi $user->pseudo! Account created here is the activation link http://devlab-back-end.test/page/activate.php?email=$user->email&token=$user->token";

                    mail($user->email, 'Activate Account' , $message , 'From: test.devlab@gmail.com');

                    header('refresh:5;url=login.php');

                    echo '<script src="../assets/register.js"></script>';
                } else {
                    echo '<h3 class="error">Internal error...</h3>';
                }

            } else {
                echo '<h3 class="error">Form has an error 😥</h3>';
            }
        }
        ?>
    </main>
</body>
</html>
<?php
