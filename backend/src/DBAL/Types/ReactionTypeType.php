<?php

namespace App\DBAL\Types;

use App\Enum\ReactionType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class ReactionTypeType extends Type
{
    public const NAME = 'reaction_type';
    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform):string
    {
        return "'" . implode("','", array_column(ReactionType::cases(), 'value')) . "'";
    }
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return ReactionType::from($value);
    }
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof ReactionType) {
            throw new \InvalidArgumentException("Invalid ReactionType");
        }
        return $value->value;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
