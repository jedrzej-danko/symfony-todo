<?php

namespace App\UI\Web\Form;

use App\Domain\PasswordPolicy;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RegisterFormDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    public string $password;
    public string $password2;

    /**
     * @param string $email
     * @param string $password
     * @param string $password2
     */
    public function __construct(string $email = '', string $password = '', string $password2 = '')
    {
        $this->email = $email;
        $this->password = $password;
        $this->password2 = $password2;
    }

    /**
     * @param ExecutionContextInterface $context
     * @param mixed $payload
     * @return void
     */
    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, mixed $payload) : void
    {
        if (!PasswordPolicy::isValid($this->password)) {
            $context->buildViolation(PasswordPolicy::DESCRIPTION)
                ->atPath('password')
                ->addViolation()
            ;
        }
        if ($this->password !== $this->password2) {
            $context->buildViolation("Passwords doesn't match")
                ->atPath("password2")
                ->addViolation()
            ;
        }
    }
}