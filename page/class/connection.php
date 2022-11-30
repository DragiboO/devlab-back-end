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
}
