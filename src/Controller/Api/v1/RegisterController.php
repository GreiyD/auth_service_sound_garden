<?php

namespace App\Controller\Api\v1;

use App\Model\RegisterRequest;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/users/register', name: 'register', methods: ['POST'])]
    public function index(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->register($request);

        return $this->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $user,
        ]);
    }
}
