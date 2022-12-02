<?php

require_once 'user.php';
require_once 'config.php';

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO user (email, password, pseudo, created_at, token, validated)
                    VALUES (:email, :password, :pseudo, :created_at, :token, :validated)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'email' => $user->email,
            'password' => md5($user->password . 'SALT'),
            'pseudo' => $user->pseudo,
            'created_at' => $user->created_at,
            'token' => $user->token,
            'validated' => $user->validated,
        ]);
    }

    public function uniqueMail($email)
    {
        $query = 'SELECT email FROM user WHERE email ="' . $email . '"';

        $result = $this->pdo->query($query);

        if ($result->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function uniquePseudo($pseudo)
    {
        $query = 'SELECT pseudo FROM user WHERE pseudo ="' . $pseudo . '"';

        $result = $this->pdo->query($query);

        if ($result->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tokenExist($token)
    {
        $query = 'SELECT token FROM user WHERE token ="' . $token . '"';

        $result = $this->pdo->query($query);

        if ($result->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validate($email, $token):bool
    {
        $date = date("Y-m-d H:i:s");
        $query = 'UPDATE user SET validated = 1, validated_at ="' . $date . '" WHERE email ="' . $email . '" AND token="' . $token .'"';

        $statement = $this->pdo->prepare($query);

        return $statement->execute();
    }

    public function connection(User $user): string
    {
        $pseudo = $user->pseudo;
        $password = md5($user->password . 'SALT');

        $query = "SELECT * FROM user WHERE pseudo ='" . $pseudo . "'";

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $userinfo = $statement->fetchAll(PDO::FETCH_ASSOC);

        $userinfo = $userinfo[0];

        $userObject = new User(
            $userinfo['email'],
            $userinfo['password'],
            '',
            $userinfo['pseudo'],
        );

        $userObject->id = $userinfo['id'];

        if ($userObject->password === $password) {
            $_SESSION['user_id'] = $userObject->id;
            $_SESSION['pseudo'] = $userObject->pseudo;
            $_SESSION['email'] = $userObject->email;

            header('Location: myprofile.php');

            return 'Bonjour ' . $userObject->pseudo;
        } else {
            return 'Mot de passe incorrect';
        }
    }
}
