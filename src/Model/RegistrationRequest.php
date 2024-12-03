<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequest
{
    #[SerializedName('name')]
    #[Assert\NotBlank(message: "Name is required")]
    #[Assert\Length(min: 2, minMessage: "Name must be at least 2 characters long")]
    protected string $name;

    #[SerializedName('email')]
    #[Assert\NotBlank(message: "Email is required")]
    #[Assert\Email(message: "Invalid email format")]
    protected string $email;

    #[SerializedName('password')]
    #[Assert\NotBlank(message: "Password is required")]
    #[Assert\Length(min: 8, minMessage: "Password must be at least 8 characters long",)]
    protected string $password;

    #[SerializedName('confirmPassword')]
    #[Assert\NotBlank(message: "Confirm Password is required")]
    #[Assert\EqualTo(propertyPath: "password", message: "Passwords do not match")]
    protected string $confirmPassword;

    public function __construct(string $name, string $email, string $password, string $confirmPassword)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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