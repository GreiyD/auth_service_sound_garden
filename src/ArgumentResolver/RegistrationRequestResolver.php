<?php

namespace App\ArgumentResolver;

use App\Exception\ValidationException;
use App\Model\RegistrationRequest;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationRequestResolver implements ValueResolverInterface
{
    protected SerializerInterface $serializer;
    protected ValidatorInterface $validator;
    protected LoggerInterface $logger;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, LoggerInterface $logger)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->logger = $logger;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === RegistrationRequest::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $registrationRequest = $this->serializer->deserialize(
            $request->getContent(),
            RegistrationRequest::class,
            JsonEncoder::FORMAT
        );

        $violations = $this->validator->validate($registrationRequest);
        if ($violations->count() > 0) {
            throw new ValidationException($violations);
        }
//        if (count($violations) > 0) {
//            $errors = [];
//            foreach ($violations as $violation) {
//                $errors[] = [
//                    'field' => $violation->getPropertyPath(),
//                    'message' => $violation->getMessage(),
//                ];
//            }
//            throw new BadRequestHttpException(json_encode(['errors' => $errors]));
//        }

        yield $registrationRequest;
    }

}