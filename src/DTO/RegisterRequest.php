<?php

namespace App\DTO;

use App\DTO\Interface\RegisterRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterRequest implements RegisterRequestInterface
{
    #[SerializedName('nickname')]
    #[Assert\NotBlank(message: "nickname_required")]
    #[Assert\Length(min: 2, minMessage: "nickname_min_length")]
    protected string $nickname;

    #[SerializedName('email')]
    #[Assert\NotBlank(message: "email_required")]
    #[Assert\Email(message: "invalid_email_format")]
    protected string $email;

    #[SerializedName('password')]
    #[Assert\NotBlank(message: "password_required")]
    #[Assert\Length(min: 8, minMessage: "password_min_length",)]
    protected string $password;

    #[SerializedName('confirmPassword')]
    #[Assert\NotBlank(message: "confirm_password_required")]
    #[Assert\EqualTo(propertyPath: "password", message: "passwords_do_not_match")]
    protected string $confirmPassword;

    public function __construct(string $nickname, string $email, string $password, string $confirmPassword)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
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

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }
}