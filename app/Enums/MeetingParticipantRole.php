<?php

namespace App\Enums;

enum MeetingParticipantRole: string
{
    case HOST = 'HOST';
    case PARTICIPANT = 'PARTICIPANT';
}