<?php

namespace App\Controller\Api\v1;

use App\DTO\LoginRequest;
use App\Service\Interface\AuthServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    protected AuthServiceInterface $userService;

    public function __construct(AuthServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/auth/login', name: 'login', methods: ['POST'])]
    public function login(LoginRequest $request): JsonResponse
    {
        $responce = $this->userService->login($request);

        return $this->json([
            'status' => 'success',
            'message' => 'You successfully logged in.',
            'user' => $responce,
        ]);
    }

    #[Route('/auth/logout', name: 'logout', methods: ['POST'])]
    public function logout(Request $request): JsonResponse    //символический логаут, пока что
    {
        return $this->json([
            'status' => 'success',
            'message' => 'Logout successful.',
        ]);
    }
}
