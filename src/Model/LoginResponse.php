<?php

namespace App\Model;

class LoginResponse
{
    protected int $id;
    protected string $name;

    public function __construct(int $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}