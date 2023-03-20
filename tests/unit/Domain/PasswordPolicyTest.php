<?php

namespace App\Tests\unit\Domain;

use App\Domain\PasswordPolicy;
use PHPUnit\Framework\TestCase;

class PasswordPolicyTest extends TestCase
{
    public function test_minimal_length() : void
    {
        self::assertFalse(PasswordPolicy::isValid('Short1!'));
        self::assertTrue(PasswordPolicy::isValid('LongPassword1!'));
    }

    public function test_requires_one_letter() : void
    {
        self::assertFalse(PasswordPolicy::isValid('01234567!!!'));
        self::assertTrue(PasswordPolicy::isValid('a01234567!!!'));
    }

    public function test_requires_one_number() : void
    {
        self::assertFalse(PasswordPolicy::isValid('password!!!'));
        self::assertTrue(PasswordPolicy::isValid('password1!!!'));
    }

    public function test_requires_one_special() : void
    {
        $basePassword = 'password1';
        self::assertFalse(PasswordPolicy::isValid($basePassword));
        for ($i = 0; $i < strlen(PasswordPolicy::SPECIALS); $i++) {
            self::assertTrue(PasswordPolicy::isValid($basePassword .= PasswordPolicy::SPECIALS[$i]));
        }
    }



}
