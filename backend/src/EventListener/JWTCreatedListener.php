<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Entity\Users;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();

        if (!$user instanceof Users) {
            // LOG pour vérifier si le user est mal typé
            error_log('JWTCreatedListener: user is not an instance of User');
            return;
        }

        $payload = $event->getData();

        // LOG pour voir l'ID de l'utilisateur
        error_log('JWTCreatedListener: user id = ' . $user->getId());

        $payload['id'] = $user->getId();
        $payload['email'] = $user->getEmail();
        $payload['roles'] = $user->getRoles();

        $event->setData($payload);
    }
}
