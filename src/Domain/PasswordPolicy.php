<?php

namespace App\Domain;

class PasswordPolicy
{
    public const DESCRIPTION = "Password must have at least 8 characters, and must contain at least one letter, one digit and one special character";
    public const SPECIALS = "!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";

    public static function isValid(string $password) : bool
    {
        if (strlen($password) < 8) {
            return false;
        }
        if (preg_match('/[a-zA-Z]+/', $password, $matches) === 0) {
            return false;
        }
        if (preg_match('/[0-9]+/', $password) === 0) {
            return false;
        }

        if (preg_match('/[' . preg_quote(self::SPECIALS, '/') . ']+/', $password) === 0) {
            return false;
        }
        return true;
    }
}