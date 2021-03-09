<?php

declare(strict_types=1);

namespace TaktikRegistr\User;

use TaktikRegistr\Writer\Writer;
use TaktikRegistr\Reader\Reader;

class User
{

    /** @var string */
    private $secret_key;

    /** @var string */
    private $x_taktik_token;

    /** @var string */
    private $bearer;

    /** @var string */
    private $version;

    /** @var bool */
    private $dev;

    public function __construct(string $secret_key, string $x_taktik_token, string $bearer, string $version, bool $dev)
    {
        $this->secret_key = $secret_key;
        $this->x_taktik_token = $x_taktik_token;
        $this->bearer = $bearer;
        $this->version = $version;
        $this->dev = $dev;
    }

    /**
     * @param string $login
     * @param string $password
     * @return Entity|null
     */
    public function login(string $login, string $password): ?Entity
    {
        $headers = ['X-Taktik-Token: '.$this->x_taktik_token, 'Content-Type: application/json'];
        $body = ['login' => $login, 'password' => $password];
        $writer = new Writer('users/login/', 'POST', $this->version, $this->dev, $headers, $body);
        $user = json_decode($writer->write());

        if (isset($user->token)) {
            $reader = new Reader($user->token, $this->secret_key);
            $decoded = $reader->read();
            if (isset($decoded->exp)) {
                $user->expiration = $decoded->exp;
            }
            if (isset($decoded->data->uid)) {
                $user->uid = $decoded->data->uid;
            }
        }
        return new Entity($user);
    }


    /**
     * @param string $uid - Unique ID of user.
     * @return Entity|null
     */
    public function get(string $uid): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('users/list/'.$uid, 'GET', $this->version, $this->dev, $headers);
        $user = json_decode($writer->write());
        return new Entity($user);
    }

    /**
     * @param string $uid - Unique ID of user.
     * @return Entity|null
     */
    public function delete(string $uid): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('users/delete/'.$uid, 'DELETE', $this->version, $this->dev, $headers);
        $user = json_decode($writer->write());
        return new Entity($user);
    }

    /**
     * @param string $uid
     * @param array $body
     * @return Entity|null
     */
    public function update(string $uid, array $body = []): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('users/update/'.$uid, 'PUT', $this->version, $this->dev, $headers, $body);
        $user = json_decode($writer->write());
        return new Entity($user);
    }

    /**
     * @param array $body
     * @return Entity|null
     */
    public function insert(array $body = []): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('users/insert/', 'POST', $this->version, $this->dev, $headers, $body);
        $user = json_decode($writer->write());
        return new Entity($user);
    }
}
