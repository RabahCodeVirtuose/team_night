<?php

namespace App\DBAL\Types;

class NotificationTypeType extends AbstractEnumType
{
    protected string $name = 'notification_type';
    protected array $values = [
        'reaction',
        'comment',
        'validation',
        'alert',
        'info',
    ];
}