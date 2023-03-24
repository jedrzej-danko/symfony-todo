<?php

namespace App\Tests\application;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function test_logins_user() : void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $client->submitForm('Login', [
            '_username' => 'test@example.com',
            '_password' => 'Password1!'
        ]);

        $this->assertResponseRedirects();
        $client->request('GET', '/');
        $this->assertSelectorTextContains('a.user-welcome', 'Welcome, test@example.com');
    }
}