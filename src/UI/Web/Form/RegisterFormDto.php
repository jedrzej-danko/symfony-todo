<?php

namespace App\UI\Web\Form;

class RegisterFormDto
{
    public readonly string $email;
    public readonly string $password;
    public readonly string $password2;

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
}