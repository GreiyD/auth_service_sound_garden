<?php

namespace App\Exception;

abstract class AbstractTranslatableExceptionAbstract extends AbstractApiException
{
    public function serTranslatedMessage(string $translatedMessage): void
    {
        $this->message = $translatedMessage;
    }
}