<?php

namespace App\Controller\Api\v1;

use App\DTO\RegisterRequest;
use App\Service\Interface\AuthServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegisterController extends AbstractController
{
    protected AuthServiceInterface $userService;
    protected TranslatorInterface $translator;

    public function __construct(AuthServiceInterface $userService, TranslatorInterface $translator)
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }

    #[Route('/auth/register', name: 'register', methods: ['POST'])]
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->userService->register($request);

        return $this->json([
            'status' => 'success',
            'message' =>  $this->translator->trans('successful_registration'),
        ]);
    }
}
