<?php require_once 'header.php';?>
<head>
    <title>Register</title>
</head>

<main>
    <div class="content h-[90vh] flex justify-center items-center flex-col gap-y-2">
        <section class="w-[270px] text-xs sm:text-sm sm:w-[350px] lg:text-lg lg:w-[425px] xl:w-[500px] h-auto xl:text-lg text-center">
            <form method="POST" class="justify-center flex flex-col items-center bg-orange-500 rounded-3xl p-10 gap-y-4 sm:gap-y-6 lg:gap-y-8 xl:gap-y-10 mb-4">

                <input type="email" name="email" placeholder="email" required class="rounded-lg p-2 text-black">
                <input type="password" name="password1" placeholder="password" required class="rounded-lg p-2 text-black">
                <input type="password" name="password2" placeholder="retype password" required class="rounded-lg p-2 text-black">
                <input type="text" name="pseudo" placeholder="pseudo" required class="rounded-lg p-2 text-black">

                <input type="submit" value="Register">
            </form>
        </section>

        <div class="h-12 text-center">
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
            $user->first_login = 0;

            $connection = new Connection();
            $result = $connection->uniqueMail($user->email);

            if ($result) {
                echo '<h3>Email déja utilisé</h3>';
            } else {

                $result = $connection->uniquePseudo($user->pseudo);

                if ($result) {
                    echo '<h3>Pseudo déja utilisé</h3>';
                } else {

                    if ($user->verify()) {
                        // record to database
                        $result = $connection->insert($user);

                        if ($result) {
                            echo '<h3>Inscription réussie</h3>';
                            echo '<p class="timer"></p>';

                            $message = "Hi $user->pseudo! Account created here is the activation link http://devlab-back-end.test/page/activate.php?email=$user->email&token=$user->token";

                            mail($user->email, 'Activate Account' , $message , 'From: test.devlab@gmail.com');

                            header('refresh:5;url=login.php');

                            echo '<script src="../assets/js/register.js"></script>';
                        } else {
                            echo '<h3>Internal error...</h3>';
                        }

                    } else {
                        echo '<h3>Mot de passe différent !</h3>';
                    }
                }
            }
        }
        ?>
        </div>
    </div>
</main>

<?php require "footer.php";?>

</body>
</html>
