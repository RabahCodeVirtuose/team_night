<?php

namespace App\Enum;

enum ReactionType: string
{
    case LIKE = 'like';
    case LOVE = 'love';
    case HAHA = 'haha';
    case WOW = 'wow';
    case GRRR = 'grrr';
}
