<?php

namespace App\Enums;

enum MeetingStatus: string
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case FINISHED = 'FINISHED';
    case CANCELLED = 'CANCELLED';
}