<?php

namespace App\Listener;

use Symfony\Component\HttpKernel\Event\RequestEvent;

class SetLocaleListener
{
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $locale = $request->headers->get('Accept-Language', 'en');
        $request->setLocale($locale);
    }
}