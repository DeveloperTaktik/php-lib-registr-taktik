<?php

declare(strict_types=1);

namespace TaktikRegistr\School;

class Entity
{
    /** @var object|null */
    public $school;

    public function __construct(?object $school)
    {
        $this->school = $school;
    }

    public function getUID(): string
    {
        return isset($this->school->uid) ? $this->school->uid : '';
    }

    public function getName(): string
    {
        return isset($this->school->name) ? $this->school->name : '';
    }

    public function getErrorCode(): int
    {
        return isset($this->school->errorCode) ? $this->school->errorCode : 0;
    }

    public function getSuccessCode(): int
    {
        return isset($this->school->successCode) ? $this->school->successCode : 0;
    }

    public function getExpiration(): int
    {
        return isset($this->school->expiration) ? $this->school->expiration : 0;
    }

    public function getToken(): string
    {
        return isset($this->school->token) ? $this->school->token : '';
    }
}