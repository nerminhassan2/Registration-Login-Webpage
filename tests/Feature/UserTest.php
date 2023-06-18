<?php

namespace Tests\Feature;

use Tests\TestCase;


class UserTest extends TestCase
{

    public function test_SignUP_form()
    {
        $response = $this->get('/en');
        $response->assertStatus(200);
    }

    public function test_SignIn_form()
    {
        $response = $this->get('/login/en');
        $response->assertStatus(200);
    }
}
