<?php

class User
{
    public string $id;
    public string $created_at;
    public string $token;
    public string $validated_at;
    public string $validated;

    public function __construct(
        public string $email,
        public string $password,
        public string $password2,
        public string $pseudo,
    )
    {
    }

    public function verify(): bool
    {
        $isValid = true;

        if ($this->email === '' || $this->pseudo === '') {
            $isValid = false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
        }

        if ($this->password === '' || $this->password !== $this->password2) {
            $isValid = false;
        }

        return $isValid;
    }
}
