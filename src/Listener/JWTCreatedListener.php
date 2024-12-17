<?php

namespace App\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function __invoke(JWTCreatedEvent $event): void
    {
        $payload = $event->getData();

        $payload['user_id'] = $event->getUser()->getId();
        $payload['nickname'] = $event->getUser()->getNickname();
        $payload['email'] = $payload['username'];
        unset($payload['username']);

        $event->setData($payload);
    }
}