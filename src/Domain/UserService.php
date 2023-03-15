<?php

namespace App\Domain;

use App\Domain\Entity\User;

class UserService
{
    private UserRepositoryInterface $repository;

    /**
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function persistUser(User $user) : User
    {
        $this->repository->save($user);
        return $user;
    }

    public function getUserByEmail(string $emailAddress) : ?User
    {
        return $this->repository->getUserByEmail($emailAddress);
    }
}