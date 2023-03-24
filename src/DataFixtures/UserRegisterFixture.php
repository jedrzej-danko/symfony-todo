<?php

namespace App\DataFixtures;

use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegisterFixture extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        $uuid = Uuid::fromString('0fa7d6a6-0db8-4017-bad0-ec8cd8c136c7');
        $user = new User($uuid, 'test@example.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'Password1!'));

        $manager->persist($user);
        $manager->flush();
    }
}
