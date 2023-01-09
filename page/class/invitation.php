<?php

class Invitation
{

    public function __construct(
        public string $userIdOwner,
        public string $albumId,
        public string $userIdRequest,
        public string $name,
        public string $pseudo
    )
    {
    }
}
