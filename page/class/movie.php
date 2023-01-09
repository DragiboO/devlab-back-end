<?php

class Movie
{

    public string $id;

    public function getMovie($movie_id)
    {
        $APIkey = "f213e718db2b8476f73cd84bb74f1963&language=fr-FR";

        $data = file_get_contents('https://api.themoviedb.org/3/movie/' . $movie_id . '?api_key=' . $APIkey);
        return json_decode($data, true);
    }
}
