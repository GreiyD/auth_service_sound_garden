<?php

namespace App\Service;

use App\Entity\User;
use App\Model\RegisterRequest;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function register(RegisterRequest $registrationRequest): User
    {
        $user = new User(
            $registrationRequest->getName(),
            $registrationRequest->getEmail(),
            $registrationRequest->getPassword(),
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}