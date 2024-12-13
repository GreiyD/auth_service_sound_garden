<?php

namespace App\ArgumentResolver;

use App\Exception\ValidationException;
use App\Model\LoginRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoginRequestResolver implements ValueResolverInterface
{
    protected SerializerInterface $serializer;
    protected ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === LoginRequest::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if($argument->getType() !== LoginRequest::class){
            return [];
        }

        $loginRequest = $this->serializer->deserialize(
            $request->getContent(),
            LoginRequest::class,
            JsonEncoder::FORMAT
        );

        $violations = $this->validator->validate($loginRequest);
        if ($violations->count() > 0) {
            throw new ValidationException($violations);
        }

        yield $loginRequest;
    }
}