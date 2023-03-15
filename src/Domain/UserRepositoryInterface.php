<?php

namespace App\Domain;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user) : void;
    public function getUserByEmail(string $emailAddress) : ?User;
}