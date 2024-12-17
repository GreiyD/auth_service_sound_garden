<?php

namespace App\Service;

use App\DTO\Interface\LoginRequestInterface;
use App\DTO\Interface\LoginResponceInterface;
use App\DTO\Interface\RegisterRequestInterface;
use App\DTO\LoginResponse;
use App\Entity\User;
use App\Exception\InvalidPasswordException;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepository;
use App\Security\RoleEnum;
use App\Service\Interface\AuthServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService implements AuthServiceInterface
{
    protected EntityManagerInterface $entityManager;
    protected UserPasswordHasherInterface $passwordHasher;
    protected UserRepository $userRepository;
    protected JWTTokenManagerInterface $jwtManager;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, JWTTokenManagerInterface $jwtManager)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;
        $this->jwtManager = $jwtManager;
    }

    public function register(RegisterRequestInterface $registrationRequest): void
    {
        $user = new User(
            nickname:  $registrationRequest->getNickname(),
            email: $registrationRequest->getEmail(),
            roles: [RoleEnum::USER]
        );

        $this->setHashedPassword($user, $registrationRequest->getPassword());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    protected function setHashedPassword(User $user, string $password): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
    }

    public function login(LoginRequestInterface  $loginRequest): LoginResponceInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $loginRequest->getEmail()]);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!password_verify($loginRequest->getPassword(), $user->getPassword())) {
            throw new InvalidPasswordException();
        }

        $jwt = $this->jwtManager->create($user);

        return new LoginResponse(
            token: $jwt
        );
    }
}