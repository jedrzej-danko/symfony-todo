<?php

namespace App\Application\UseCase;

class RegisterUser
{
    public readonly string $emailAddress;
    public readonly string $password;

    /**
     * @param string $emailAddress
     * @param string $password
     */
    public function __construct(string $emailAddress, string $password)
    {
        $this->emailAddress = $emailAddress;
        $this->password = $password;
    }



}