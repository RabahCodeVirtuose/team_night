<?php

namespace App\DBAL\Types;
use App\Enum\NotificationType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class NotificationTypeType extends Type
{
    public const NAME = 'notification_type';
    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform):string
    {
        return "'" . implode("','", array_column(NotificationType::cases(), 'value')) . "'";
    }
    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return NotificationType::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        if (!$value instanceof NotificationType) {
            throw new \InvalidArgumentException("Invalid NotificationType.");
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
