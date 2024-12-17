<?php

namespace App\Service\Interface;

use App\DTO\Interface\LoginRequestInterface;
use App\DTO\Interface\LoginResponceInterface;
use App\DTO\Interface\RegisterRequestInterface;

interface AuthServiceInterface
{
    public function register(RegisterRequestInterface $registrationRequest): void;

    public function login(LoginRequestInterface  $loginRequest): LoginResponceInterface;
}