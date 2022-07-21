<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    //need data user from database
    public function testLoginSuccess()
    {

        $data = [
          'email' => 'test1@gmail.com',
          'password' => 'torabika',
        ];

        $this->json('POST','api/user/login',$data,['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testLoginFailed()
    {
        $data = [];

        $this->json('POST','api/user/login',$data,['Accept' => 'application/json'])
            ->assertStatus(401);
    }
}
