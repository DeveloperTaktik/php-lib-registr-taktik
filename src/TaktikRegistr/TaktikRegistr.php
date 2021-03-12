<?php

declare(strict_types=1);

namespace TaktikRegistr;

use TaktikRegistr\School\School;
use TaktikRegistr\User\User;

class TaktikRegistr
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

    public function __construct(array $conf = [])
    {
        $this->secret_key = isset($conf['secret_key']) ? $conf['secret_key'] : '';
        $this->x_taktik_token = isset($conf['x_taktik_token']) ? $conf['x_taktik_token'] : '';
        $this->bearer = isset($conf['bearer']) ? $conf['bearer'] : '';
        $this->version = isset($conf['version']) ? $conf['version'] : '1.0';
        $this->dev = isset($conf['dev']) ? $conf['dev'] : false;
    }

    public function school(): School
    {
        return new School(
            $this->secret_key,
            $this->x_taktik_token,
            $this->bearer,
            $this->version,
            $this->dev
        );
    }

    public function user(): User
    {
        return new User(
            $this->secret_key,
            $this->x_taktik_token,
            $this->bearer,
            $this->version,
            $this->dev
        );
    }
}
