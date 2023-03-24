<?php

namespace App\Tests\application;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
    public function test_register_user() :  void
    {
        $client = static::createClient();
        $client->request('GET', '/register');
        $client->submitForm('Register', [
            'register_form[email]' => 'test-register@example.com',
            'register_form[password]' => 'Password1!',
            'register_form[password2]' => 'Password1!'
        ]);
        $this->assertResponseRedirects('/registered');

        $client->request('GET', '/login');
        $client->submitForm('Login', [
            '_username' => 'test-register@example.com',
            '_password' => 'Password1!'
        ]);

        $this->assertResponseRedirects();
        $client->request('GET', '/');
        $this->assertSelectorTextContains('a.user-welcome', 'Welcome, test-register@example.com', message: "No sign of logged in user on homepage");
    }


}