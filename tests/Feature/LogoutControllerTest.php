<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    public function testLogoutNoAuthorization()
    {
        $this->json('GET','api/user/logout',[],[
            'Authorization' => '',
            'Accept' => 'application/json'
        ])->assertStatus(404);
    }

    public function testLogoutSuccess()
    {
        //need fresh bearer token to assert 200
        $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzNjQ2NDQsImV4cCI6MTY1ODM2ODI0NCwibmJmIjoxNjU4MzY0NjQ0LCJqdGkiOiJLbE1UOE5zTkdQazZpUml5Iiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Baqlk142s8s77HyxExzzk4IQH9g3ysO8oozRtraq7S4';

        $this->json('GET','api/user/logout',[],[
            'Authorization' => $token,
            'Accept' => 'application/json'
        ])->assertStatus(200);
    }
}
