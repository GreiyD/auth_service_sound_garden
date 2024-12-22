<?php

namespace App\DTO;

use App\DTO\Interface\LoginRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class LoginRequest implements LoginRequestInterface
{
    #[SerializedName('email')]
    #[Assert\NotBlank(message: "email_required")]
    #[Assert\Email(message: "invalid_email_format")]
    protected string $email;

    #[SerializedName('password')]
    #[Assert\NotBlank(message: "password_required")]
    protected string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}