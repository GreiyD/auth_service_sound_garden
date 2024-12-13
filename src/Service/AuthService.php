<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\InvalidPasswordException;
use App\Exception\UserNotFoundException;
use App\Model\LoginRequest;
use App\Model\LoginResponse;
use App\Model\RegisterRequest;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService
{
    protected EntityManagerInterface $entityManager;
    protected UserPasswordHasherInterface $passwordHasher;
    protected UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $registrationRequest): User
    {
        $user = new User(
            $registrationRequest->getName(),
            $registrationRequest->getEmail()
        );

        $this->setHashedPassword($user, $registrationRequest->getPassword());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    protected function setHashedPassword(User $user, string $password): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
    }

    public function login(LoginRequest $loginRequest): LoginResponse
    {
        $user = $this->userRepository->findOneBy(['email' => $loginRequest->getEmail()]);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!password_verify($loginRequest->getPassword(), $user->getPassword())) {
            throw new InvalidPasswordException();
        }

        return new LoginResponse(
            $user->getId(),
            $user->getName(),
        );
    }
}