<?php

namespace App\Enum;

enum NotificationType: string
{
    case REACTION = 'reaction';
    case COMMENT = 'comment';
    case VALIDATION = 'validation';
    case ALERT = 'alert';
    case INFO = 'info';
}
