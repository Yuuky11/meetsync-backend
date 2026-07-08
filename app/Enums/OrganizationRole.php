<?php

namespace App\Enums;

enum OrganizationRole: string
{
    case OWNER = 'OWNER';
    case MEMBER = 'MEMBER';
}