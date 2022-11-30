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

    <div class="w-[300px] h-auto text-lg divabsolute text-center">

        <form method="POST" class="flex flex-col items-center bg-orange-500 rounded-3xl p-10 gap-y-10 mb-4">
                <input type="email" name="email" placeholder="email" class="rounded-lg p-2">
                <input type="password" name="password" placeholder="password" class="rounded-lg p-2">
                <input type="submit" value="Login" name="login">
            </form>

            
            <a href="register.php">Or Register</a>

    </div>



</body>
</html>