<?php

namespace App;

use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Doctrine\DBAL\Types\Type;
use App\DBAL\Types\NotificationTypeType;
use App\DBAL\Types\ReactionTypeType;
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @throws Exception
     */
    public function boot(): void
    {
        parent::boot();

        if (!Type::hasType('notification_type')) {
            Type::addType('notification_type', NotificationTypeType::class);
        }

        if (!Type::hasType('reaction_type')) {
            Type::addType('reaction_type', ReactionTypeType::class);
        }
    }
}
