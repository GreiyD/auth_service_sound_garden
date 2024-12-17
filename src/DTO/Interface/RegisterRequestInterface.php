<?php

namespace App\DTO\Interface;

interface RegisterRequestInterface
{
    public function getNickname(): string;
    public function getEmail(): string;
    public function getPassword(): string;
}