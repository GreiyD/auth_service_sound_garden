<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends RuntimeException
{
    protected ConstraintViolationListInterface $violations;

    public function __construct(ConstraintViolationListInterface $violations){
        $this->violations = $violations;
        parent::__construct('Validation failed');
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}