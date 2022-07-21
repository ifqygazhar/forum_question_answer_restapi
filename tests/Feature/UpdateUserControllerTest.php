<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class UpdateUserControllerTest extends TestCase
{
    //need fresh Bearer token and data on database
    public function testUpdateFailed()
    {
        $this->json('PUT','api/user/test/update/1',[],['accept' => 'application/json'])
            ->assertStatus(404);
    }

    public function testUpdateSuccess()
    {
        // need Bearer token
        $data = [
            'name' => 'testedit2',
            'password' => 'torabika',
            'password_confirmation' => 'torabika',
        ];

        $this->json('PUT','api/user/testing/update/3',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ]) ->assertStatus(200);
    }

}
