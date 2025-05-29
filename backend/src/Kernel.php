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
    /**
     * @throws Exception
     */
    public function boot(): void
    {
        parent::boot();

        if (!Type::hasType(NotificationTypeType::NAME)) {
            Type::addType(NotificationTypeType::NAME, NotificationTypeType::class);
        }

        if (!Type::hasType(ReactionTypeType::NAME)) {
            Type::addType(ReactionTypeType::NAME, ReactionTypeType::class);
        }
    }
    use MicroKernelTrait;
}
