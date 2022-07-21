<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    public function testRegisterFailedRequired()
    {
        $data = [];

        $this->json('POST','api/user/register',$data,['Accept' => 'application/json'])
            ->assertStatus(409);
    }

    public function testRegisterSuccess()
    {
        $data = [
            'name' => 'testing1',
            'username' => 'testing1',
            'email' => 'test12@gmail.com',
            'password' => 'torabika',
            'password_confirmation' => 'torabika',
        ];

        $this->json('POST','api/user/register',$data,['Accept' => 'application/json'])
            ->assertStatus(201);
    }


}
