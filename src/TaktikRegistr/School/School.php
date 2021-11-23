<?php

declare(strict_types=1);

namespace TaktikRegistr\School;

use TaktikRegistr\Writer\Writer;

class School
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
     * @param string $uid - Unique ID of school.
     * @return Entity|null
     */
    public function get(string $uid): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('schools/list/'.$uid, 'GET', $this->version, $this->dev, $headers);
        $school = json_decode($writer->write());
        return new Entity($school);
    }

    /**
     * @param array $body - ['query' => '?', 'limit' => 50, 'page' => 1].
     * @return array|null
     */
    public function search(array $body = []): ?array
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('schools/search/', 'POST', $this->version, $this->dev, $headers, $body);
        $schools = json_decode($writer->write());
        if (is_array($schools) && $schools->errorCode == 0) {
            foreach ($schools as $key => $school) {
                $schools[$key] = new Entity($school);
            }
        }
        if ($schools->errorCode > 0) {
            $schools = null;
        }
        return $schools;
    }

    /**
     * @param string $uid - Unique ID of school.
     * @return Entity|null
     */
    public function delete(string $uid): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('schools/delete/'.$uid, 'DELETE', $this->version, $this->dev, $headers);
        $school = json_decode($writer->write());
        return new Entity($school);
    }

    /**
     * @param string $uid - Unique ID of school.
     * @param array $body
     * @return Entity|null
     */
    public function update(string $uid, array $body = []): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('schools/update/'.$uid, 'PUT', $this->version, $this->dev, $headers, $body);
        $school = json_decode($writer->write());
        return new Entity($school);
    }

    /**
     * @param array $body
     * @return Entity|null
     */
    public function insert(array $body = []): ?Entity
    {
        $headers = ['Authorization: Bearer '.$this->bearer];
        $writer = new Writer('schools/insert/', 'POST', $this->version, $this->dev, $headers, $body);
        $school = json_decode($writer->write());
        return new Entity($school);
    }

}
