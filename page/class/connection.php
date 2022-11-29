<?php

require_once 'user.php';

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=devlab-back-end;host=127.0.0.1', 'root', '');
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO user (email, password, pseudo, created_at)
                    VALUES (:email, :password, :pseudo, :created_at)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'email' => $user->email,
            'password' => md5($user->password . 'SALT'),
            'pseudo' => $user->pseudo,
            'created_at' => $user->created_at,
        ]);
    }
}
