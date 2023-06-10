<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Blocked = 'blocked';
    case Whitelisted = 'whitelisted';
}
