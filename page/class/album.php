<?php

class Album
{
    public string $id;
    public string $pseudo;

    public function __construct(
        public string $name,
        public string $isPublic,
        public string $isWatched,
        public string $isWished,
        public string $ownerId,
    )
    {
    }

}
