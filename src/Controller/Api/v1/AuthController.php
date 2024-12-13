<?php

namespace App\Controller\Api\v1;

use App\Model\LoginRequest;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    protected AuthService $userService;

    public function __construct(AuthService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/users/login', name: 'login', methods: ['POST'])]
    public function login(LoginRequest $request): JsonResponse
    {
        $userResponce = $this->userService->login($request);

        return $this->json([
            'status' => 'success',
            'message' => 'You successfully logged in.',
            'user' => $userResponce,
        ]);
    }
}
