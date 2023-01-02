<?php

require_once 'user.php';
require_once 'config.php';
require_once 'album.php';

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO user (email, password, pseudo, created_at, token, validated, first_login)
                    VALUES (:email, :password, :pseudo, :created_at, :token, :validated, :first_login)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'email' => $user->email,
            'password' => md5($user->password . 'SALT'),
            'pseudo' => $user->pseudo,
            'created_at' => $user->created_at,
            'token' => $user->token,
            'validated' => $user->validated,
            'first_login' => $user->first_login,
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

    public function validate($email, $token): bool
    {
        $date = date("Y-m-d H:i:s");
        $query = 'UPDATE user SET validated = 1, validated_at ="' . $date . '" WHERE email ="' . $email . '" AND token="' . $token . '"';

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

        if (count($userinfo) == 0) {
            return 'Utilisateur inconnu(e)';
        } else {
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

                $query = 'SELECT first_login FROM user WHERE pseudo ="' . $userObject->pseudo . '"';
                $result = $this->pdo->query($query);

                if ($result->fetchColumn() == 0) {
                    $this->firstLogin($userObject->pseudo);

                    $album = new Album('Visionnés', 1, 1, 0, $userObject->id);
                    $this->createAlbum($album);
                    $album = new Album('Liste des envies', 1, 0, 1, $userObject->id);
                    $this->createAlbum($album);

                    $query = 'SELECT id FROM album WHERE owner_id =' . $userObject->id;
                    $result = $this->pdo->query($query);

                    $statement = $result->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($statement as $id) {
                        echo $id['id'];
                        $query = 'INSERT INTO user_album (user_id, album_id, is_owner) VALUES (' . $userObject->id . ', ' . $id['id'] . ', 1)';
                        $statement = $this->pdo->prepare($query);
                        $statement->execute();
                    }
                }

                header('refresh:3;url=myprofile.php');

                return 'Bonjour ' . $userObject->pseudo;
            } else {
                return 'Mot de passe incorrect';
            }
        }
    }

    public function firstLogin($pseudo)
    {
        $query = 'UPDATE user SET first_login = 1 WHERE pseudo ="' . $pseudo . '"';

        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function createAlbum(Album $album): bool
    {
        $query = 'INSERT INTO album (name, is_public, is_watched, is_wished, owner_id)
                    VALUES (:name, :isPublic, :isWatched, :isWished, :ownerId)';

        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'name' => $album->name,
            'isPublic' => $album->isPublic,
            'isWatched' => $album->isWatched,
            'isWished' => $album->isWished,
            'ownerId' => $album->ownerId,
        ]);
    }

    public function addOwnerLastAlbum($user_id)
    {
        $query = 'SELECT id FROM album WHERE owner_id = ' . $user_id . ' ORDER BY id DESC LIMIT 1';
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        $query2 = 'INSERT INTO user_album (user_id, album_id, is_owner) VALUES (' . $user_id . ', ' . $statement[0]['id'] . ', 1)';
        $statement2 = $this->pdo->prepare($query2);
        $statement2->execute();
    }

    public function queryAlbum($user_id, $type)
    {
        if ($type === 0) {
            $query = 'SELECT * FROM album WHERE owner_id = ' . $user_id . ' AND is_watched = 0 AND is_wished = 0';
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            foreach ($statement as $album) {
                echo '
                    <a href="../album.php?id='. $album['id'] .'">
                        <div>
                            <p>'. $album['name'] .'</p>
                        </div>
                    </a>
                    ';
            }
        }

        if ($type === 1) {
            $query = 'SELECT * FROM album WHERE owner_id = ' . $user_id . ' AND is_watched = 1';
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            foreach ($statement as $album) {
                echo '
                    <a href="../album.php?id='. $album['id'] .'">
                        <div>
                            <p>'. $album['name'] .'</p>
                        </div>
                    </a>
                    ';
            }
        }

        if ($type === 2) {
            $query = 'SELECT * FROM album WHERE owner_id = ' . $user_id . ' AND is_wished = 1';
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            foreach ($statement as $album) {
                echo '
                    <a href="../album.php?id='. $album['id'] .'">
                        <div>
                            <p>'. $album['name'] .'</p>
                        </div>
                    </a>
                    ';
            }
        }


    }
}
