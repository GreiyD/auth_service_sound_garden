<?php

namespace App\Security;

enum RoleEnum: string
{
    case USER = 'ROLE_USER';
    case PERFORMER = 'ROLE_PERFORMER';
    case MODERATOR = 'ROLE_MODERATOR';
}
