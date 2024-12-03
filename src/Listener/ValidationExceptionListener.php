<?php

namespace App\Listener;

use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;

class ValidationExceptionListener
{
    protected SerializerInterface $serializer;
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();
        if(!$throwable instanceof ValidationException){
            return;
        }

        $violations = $throwable->getViolations();

        $errors = [];
        foreach ($violations as $violation) {
            $errors[] = [
                'field' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
            ];
        }

        $response = new JsonResponse([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $errors,
        ], JsonResponse::HTTP_BAD_REQUEST);

        $event->setResponse($response);
    }
}