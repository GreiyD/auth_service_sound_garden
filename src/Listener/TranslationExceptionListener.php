<?php

namespace App\Listener;

use App\Exception\AbstractTranslatableExceptionAbstract;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class TranslationExceptionListener
{
    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        if (!$throwable instanceof AbstractTranslatableExceptionAbstract) {
            return;
        }

        $message = $throwable->getMessage();
        $translatedMessage = $this->translator->trans($message, [], 'errors');

        $throwable->serTranslatedMessage($translatedMessage);
    }
}