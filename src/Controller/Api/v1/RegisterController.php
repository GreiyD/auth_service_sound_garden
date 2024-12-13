<?php

namespace App\Controller\Api\v1;

use App\Model\RegisterRequest;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    protected AuthService $userService;

    public function __construct(AuthService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/users/register', name: 'register', methods: ['POST'])]
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->userService->register($request);

        return $this->json([
            'status' => 'success',
            'message' => 'User registered successfully'
        ]);
    }
}
