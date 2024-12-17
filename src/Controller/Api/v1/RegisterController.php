<?php

namespace App\Controller\Api\v1;

use App\DTO\RegisterRequest;
use App\Service\Interface\AuthServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    protected AuthServiceInterface $userService;

    public function __construct(AuthServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/auth/register', name: 'register', methods: ['POST'])]
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->userService->register($request);

        return $this->json([
            'status' => 'success',
            'message' => 'User registered successfully'
        ]);
    }
}
