<?php

namespace App\Exception;

class InvalidPasswordException extends AbstractTranslatableExceptionAbstract
{
    public function __construct()
    {
        parent::__construct('invalid_password', 401);
    }
}