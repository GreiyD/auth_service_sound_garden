<?php

namespace App\Exception;

class UserNotFoundException extends AbstractTranslatableExceptionAbstract
{
    public function __construct()
    {
        parent::__construct('users_email_not_found', 404);
    }
}