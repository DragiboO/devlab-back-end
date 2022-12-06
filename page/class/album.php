<?php

class Album
{
    public string $id;

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
