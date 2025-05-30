<?php

namespace App\DBAL\Types;

class ReactionTypeType  extends AbstractEnumType
{
    protected string $name = 'reaction_type';
    protected array $values = [
        'like',
        'love',
        'haha',
        'wow',
        'grrr',
    ];
}
