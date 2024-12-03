<?php

namespace App\Controller\Api\v1;

use App\Model\RegistrationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/users/register', name: 'register', methods: ['POST'])]
    public function index(RegistrationRequest $request): JsonResponse
    {
        return $this->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => $request,
        ]);
    }
}
