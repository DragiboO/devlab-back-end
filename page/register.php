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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register</h1>

    <main class="content">
        <section>
            <form method="POST">

                <input type="email" name="email" placeholder="email" required>
                <input type="password" name="password1" placeholder="password" required>
                <input type="password" name="password2" placeholder="retype password" required>
                <input type="text" name="pseudo" placeholder="pseudo" required>

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

            if ($user->verify()) {
                // record to database
                $connection = new Connection();
                $result = $connection->insert($user);

                if ($result) {
                    echo '<h3 class="success">Registered with success 😎</h3>';
                    echo '<p class="timer"></p>';

                    header('refresh:3;url=login.php');

                    echo '<script type="text/javascript">',
                    "let timer = document.querySelector('.timer')
                    
                    function sleep(ms) {
                        return new Promise(resolve => setTimeout(resolve, ms));
                    }

                    async function time() {
                        for (let i = 3; i > 0; i--) {
                            timer.innerHTML = 'Redirect to logIn page in ' + i + ' ...'
                            await sleep(1000)
                        }
                    }
                    
                    time()",
                    '</script>';
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
