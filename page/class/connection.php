<?php

require_once 'user.php';
require_once 'config.php';
require_once 'album.php';
require_once 'movie.php';
require_once 'invitation.php';

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

    public function uniqueMail($email): bool
    {
        $query = 'SELECT email FROM user WHERE email ="' . $email . '"';

        $result = $this->pdo->query($query);

        if ($result->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function uniquePseudo($pseudo): bool
    {
        $query = 'SELECT pseudo FROM user WHERE pseudo ="' . $pseudo . '"';

        $result = $this->pdo->query($query);

        if ($result->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tokenExist($token): bool
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
                        $query = 'INSERT INTO user_album (user_id, album_id, is_owner) VALUES (' . $userObject->id . ', ' . $id['id'] . ', 1)';
                        $statement = $this->pdo->prepare($query);
                        $statement->execute();
                    }
                }

                header('refresh:2;url=profile.php?id=' . $userObject->id);

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
            $query = 'SELECT * FROM album WHERE owner_id = ' . $user_id . ' AND is_watched = 0 AND is_wished = 0 ORDER BY id DESC';
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($statement === []) {
                return null;
            } else {
                foreach ($statement as $album) {
                    $objectAlbum = new Album(
                        $album["name"],
                        $album["is_public"],
                        0,
                        0,
                        $album["owner_id"]
                    );
                    $objectAlbum->id = $album["id"];

                    $list[] = $objectAlbum;
                }
            }
            return $list;
        }

        if ($type === 1) {
            $query = 'SELECT * FROM album WHERE owner_id = ' . $user_id . ' AND is_watched = 1';
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($statement === []) {
                return null;
            } else {
                foreach ($statement as $album) {
                    $objectAlbum = new Album(
                        $album["name"],
                        $album["is_public"],
                        1,
                        0,
                        $album["owner_id"]
                    );
                    $objectAlbum->id = $album["id"];

                    $list[] = $objectAlbum;
                }
            }
            return $list;
        }

        if ($type === 2) {
            $query = 'SELECT * FROM album WHERE owner_id = ' . $user_id . ' AND is_wished = 1';
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($statement === []) {
                return null;
            } else {
                foreach ($statement as $album) {
                    $objectAlbum = new Album(
                        $album["name"],
                        $album["is_public"],
                        0,
                        1,
                        $album["owner_id"]
                    );
                    $objectAlbum->id = $album["id"];

                    $list[] = $objectAlbum;
                }
            }
            return $list;
        }

        if ($type === 3) {
            $query = 'SELECT album_id, owner_id, name, is_watched, is_wished, is_public, pseudo  FROM user_album
                      LEFT JOIN album ON user_album.album_id = album.id
                      LEFT JOIN user ON album.owner_id = user.id
                      WHERE is_owner = 0 AND user_id = ' . $user_id;
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($statement === []) {
                return null;
            } else {
                foreach ($statement as $album) {
                    $objectAlbum = new Album(
                        $album["name"],
                        $album["is_public"],
                        $album["is_watched"],
                        $album["is_wished"],
                        $album["owner_id"]
                    );
                    $objectAlbum->id = $album["album_id"];
                    $objectAlbum->pseudo = $album["pseudo"];

                    $list[] = $objectAlbum;
                }
            }
            return $list;
        }

        if ($type === 4) {
            $query = 'SELECT album.id, owner_id, name, is_watched, is_wished, is_public, pseudo FROM album
                      LEFT JOIN user ON user.id = album.owner_id
                      WHERE album.id = ' . $user_id;
            $result = $this->pdo->query($query);
            $statement = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($statement === []) {
                return null;
            } else {
                foreach ($statement as $album) {
                    $objectAlbum = new Album(
                        $album["name"],
                        $album["is_public"],
                        $album["is_watched"],
                        $album["is_wished"],
                        $album["owner_id"]
                    );
                    $objectAlbum->id = $album["id"];
                    $objectAlbum->pseudo = $album["pseudo"];

                    $list[] = $objectAlbum;
                }
            }
            return $list[0];
        }

        return "";
    }

    public function authorizedUser($user_id, $album_id): bool
    {
        $query = 'SELECT * from user_album WHERE user_id = ' . $user_id . ' AND album_id = ' . $album_id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return false;
        } else {
            return true;
        }
    }

    public function checkIfInAlbum($album_id, $title_id)
    {
        $query = 'SELECT * from album_title WHERE album_id = ' . $album_id . ' AND title_id = ' . $title_id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return true;
        } else {
            return false;
        }
    }

    public function insertTitle($album_id, $title_id)
    {
        $query = 'INSERT INTO album_title (album_id, title_id) VALUES ('. $album_id .','. $title_id .')';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function userExist($id): bool
    {
        $query = 'SELECT id FROM user WHERE id = ' . $id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return false;
        } else {
            return true;
        }
    }

    public function getPseudo($id)
    {
        $query = 'SELECT pseudo FROM user WHERE id = ' . $id;
        $result = $this->pdo->query($query);
        $pseudo = $result->fetchAll(PDO::FETCH_ASSOC);
        return $pseudo[0]['pseudo'];
    }

    public function getOwner($album_id)
    {
        $query = 'SELECT owner_id FROM album WHERE id = ' . $album_id;
        $result = $this->pdo->query($query);
        $ownerId = $result->fetchAll(PDO::FETCH_ASSOC);
        return $ownerId[0]['owner_id'];
    }

    public function albumExist($id): bool
    {
        $query = 'SELECT id FROM album WHERE id = ' . $id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return false;
        } else {
            return true;
        }
    }

    public function countLike($id)
    {
        $query = 'SELECT COUNT(album_id) FROM album_like
                  WHERE album_id = ' . $id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        return $statement[0]['COUNT(album_id)'];
    }

    public function like($user_id, $album_id)
    {
        $query = 'SELECT * FROM album_like
                  WHERE album_id = ' . $album_id . ' AND user_id = ' . $user_id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            $query = 'INSERT INTO album_like (album_id, user_id)
                      VALUES ('. $album_id .','. $user_id .')';
            $statement = $this->pdo->prepare($query);
            $statement->execute();

        } else {
            $query = 'DELETE FROM album_like
                      WHERE  album_id = '. $album_id .' AND user_id = '. $user_id;
            $statement = $this->pdo->prepare($query);
            $statement->execute();
        }
    }

    public function isLiked($user_id, $album_id): bool
    {
        $query = 'SELECT * FROM album_like
                  WHERE album_id = ' . $album_id . ' AND user_id = ' . $user_id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return false;
        } else {
            return true;
        }
    }

    public function titleInAlbum($id)
    {
        $query = 'SELECT title_id FROM album_title
                  WHERE album_id = ' . $id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return 'vide';
        } else {
            foreach ($statement as $title) {
                $movieObject = new Movie();
                $movieObject->id = $title['title_id'];
                $list[] =$movieObject;
            }
            return $list;
        }
    }

    public function getUserString($str): string
    {
        $query = 'SELECT pseudo, id FROM user 
                  WHERE pseudo LIKE "%' . $str . '%"';
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($statement);
    }

    public function isAlreadyInvited($album_id, $user_id_request): bool
    {
        $query = 'SELECT album_id, user_id_request FROM pending_request 
                  WHERE album_id = ' . $album_id . ' AND user_id_request = ' . $user_id_request;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement === []) {
            return false;
        } else {
            return true;
        }
    }

    public function createInvitation($owner_id, $album_id, $user_id_request)
    {
        $query = 'INSERT INTO pending_request (user_id_owner, album_id, user_id_request) VALUES ('. $owner_id .','. $album_id .','. $user_id_request .')';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function getInvitationRequest($user_id)
    {
        $query = 'SELECT user_id_owner, album_id, user_id_request, name, pseudo FROM pending_request
                  LEFT JOIN album ON album.id = pending_request.album_id
                  LEFT JOIN user ON user.id = pending_request.user_id_owner
                  WHERE user_id_request = ' . $user_id;
        $result = $this->pdo->query($query);
        $statement = $result->fetchAll(PDO::FETCH_ASSOC);

        if ($statement !== []) {

            foreach ($statement as $invitation) {
                $invitationObject = new Invitation(
                    $invitation['user_id_owner'],
                    $invitation['album_id'],
                    $invitation['user_id_request'],
                    $invitation['name'],
                    $invitation['pseudo']
                );

                $list[] =$invitationObject;
            }
            return $list;
        }
    }

    public function removeRequest($album_id, $user_id)
    {
        $query = 'DELETE FROM pending_request
                  WHERE  album_id = '. $album_id .' AND user_id_request = '. $user_id;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function addUserAlbum($album_id, $user_id)
    {
        $query = 'INSERT INTO user_album (user_id, album_id, is_owner) VALUES (' . $user_id . ', ' . $album_id . ', 0)';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

}
