<?php

declare(strict_types=1);

namespace TaktikRegistr\User;

class Entity
{
    /** @var object|null */
    public $user;

    public function __construct(?object $user)
    {
        $this->user = $user;
    }

    public function getUID(): string
    {
        return isset($this->user->uid) ? $this->user->uid : '';
    }

    public function getEmail(): string
    {
        return isset($this->user->email) ? $this->user->email : '';
    }

    public function getPhone(): string
    {
        return isset($this->user->phone) ? $this->user->phone : '';
    }

    public function getGender(): int
    {
        return isset($this->user->gender) ? $this->user->gender : 0;
    }

    public function getFirstName(): string
    {
        return isset($this->user->firstname) ? $this->user->firstname : '';
    }

    public function getLastName(): string
    {
        return isset($this->user->lastname) ? $this->user->lastname : '';
    }

    public function getDegreeBefore(): string
    {
        return isset($this->user->degreeBefore) ? $this->user->degreeBefore : '';
    }

    public function getDegreeAfter(): string
    {
        return isset($this->user->degreeAfter) ? $this->user->degreeAfter : '';
    }

    public function getCountry(): string
    {
        return isset($this->user->country) ? $this->user->country : '';
    }

    public function getUIDSchool(): string
    {
        return isset($this->user->uidSchool) ? $this->user->uidSchool : '';
    }

    public function getErrorCode(): int
    {
        return isset($this->user->errorCode) ? $this->user->errorCode : 0;
    }

    public function getSuccessCode(): int
    {
        return isset($this->user->successCode) ? $this->user->successCode : 0;
    }

    public function getExpiration(): int
    {
        return isset($this->user->expiration) ? $this->user->expiration : 0;
    }

    public function getToken(): string
    {
        return isset($this->user->token) ? $this->user->token : '';
    }
}