<?php

namespace App\Controller\Api\v1;

use App\DTO\LoginRequest;
use App\Service\Interface\AuthServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class AuthController extends AbstractController
{
    protected AuthServiceInterface $userService;
    protected TranslatorInterface $translator;

    public function __construct(AuthServiceInterface $userService, TranslatorInterface $translator)
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }

    #[Route('/auth/login', name: 'login', methods: ['POST'])]
    public function login(LoginRequest $request): JsonResponse
    {
        $responce = $this->userService->login($request);

        return $this->json([
            'status' => 'success',
            'message' =>  $this->translator->trans('successful_login'),
            'user' => $responce,
        ]);
    }

    #[Route('/auth/logout', name: 'logout', methods: ['POST'])]
    public function logout(Request $request): JsonResponse    //символический логаут, пока что
    {
        return $this->json([
            'status' => 'success',
            'message' =>  $this->translator->trans('successful_logout'),
        ]);
    }
}
