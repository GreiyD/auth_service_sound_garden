<?php

namespace App\DTO;

use App\DTO\Interface\LoginResponceInterface;

class LoginResponse implements LoginResponceInterface
{
    protected string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}