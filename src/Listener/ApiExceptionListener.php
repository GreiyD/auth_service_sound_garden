<?php

namespace App\Listener;

use App\Exception\AbstractApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;

class ApiExceptionListener
{
    protected SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        if(!$throwable instanceof AbstractApiException){
            return;
        }

        $response = new JsonResponse([
            'status' => 'error',
            'message' => $throwable->getMessage(),
        ], $throwable->getStatusCode());

        $event->setResponse($response);
    }
}