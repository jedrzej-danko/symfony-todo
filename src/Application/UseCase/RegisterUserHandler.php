<?php

namespace App\Application\UseCase;

use App\Application\Exception\EmailAddressReuse;
use App\Application\Exception\PasswordException;
use App\Domain\Entity\User;
use App\Domain\PasswordPolicy;
use App\Domain\UserService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserHandler implements MessageHandlerInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    private UserService $userService;

    /**
     * @param UserPasswordHasherInterface $passwordHasher
     * @param UserService $userService
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher, UserService $userService)
    {
        $this->passwordHasher = $passwordHasher;
        $this->userService = $userService;
    }


    /**
     * @throws PasswordException
     * @throws EmailAddressReuse
     */
    public function __invoke(RegisterUser $command) : void
    {
        if (!PasswordPolicy::isValid($command->password)) {
            throw new PasswordException(PasswordPolicy::DESCRIPTION);
        }
        if ($this->userService->getUserByEmail($command->emailAddress) !== null) {
            throw new EmailAddressReuse("Email address {$command->emailAddress} is taken");
        }
        $user = new User();
        $user->setEmail($command->emailAddress);
        $user->setPassword($this->passwordHasher->hashPassword($user, $command->password));
        $this->userService->persistUser($user);
    }
}