<?php

namespace App\DTO\Interface;

interface LoginRequestInterface
{
    public function getEmail(): string;
    public function getPassword(): string;
}