<?php

namespace App\Exception;

class UserNotFoundException extends ApiException
{
    public function __construct()
    {
        parent::__construct('There is no user with such email', 404);
    }
}