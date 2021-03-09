<?php

declare(strict_types=1);

namespace TaktikRegistr\Reader;

use Firebase\JWT\JWT;

class Reader
{
    /** @var string */
    private $user_token;

    /** @var string */
    private $secret_key;

    public function __construct(string $user_token, string $secret_key)
    {
        $this->user_token = $user_token;
        $this->secret_key = $secret_key;
    }

    public function read()
    {
        JWT::$leeway = 20;
        return JWT::decode($this->user_token, $this->secret_key, ['HS256']);
    }
}
