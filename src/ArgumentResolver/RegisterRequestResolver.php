<?php

namespace App\ArgumentResolver;

use App\Exception\ValidationException;
use App\DTO\RegisterRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterRequestResolver implements ValueResolverInterface
{
    protected SerializerInterface $serializer;
    protected ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if($argument->getType() !== RegisterRequest::class){
            return [];
        }

        $registrationRequest = $this->serializer->deserialize(
            $request->getContent(),
            RegisterRequest::class,
            JsonEncoder::FORMAT
        );

        $violations = $this->validator->validate($registrationRequest);
        if ($violations->count() > 0) {
            throw new ValidationException($violations);
        }

        yield $registrationRequest;
    }
}