<?php

namespace App\Enums;

enum InvitationStatus: string
{
    case INVITED = 'INVITED';
    case ACCEPTED = 'ACCEPTED';
    case DECLINED = 'DECLINED';
}