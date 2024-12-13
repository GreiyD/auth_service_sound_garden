<?php

namespace App\Exception;

class InvalidPasswordException extends ApiException
{
    public function __construct()
    {
        parent::__construct('Invalid password', 401);
    }
}