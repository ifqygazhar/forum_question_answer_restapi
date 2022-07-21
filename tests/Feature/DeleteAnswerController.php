<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteAnswerController extends TestCase
{
    //need fresh Bearer token and data on database
    public function testDeleteAnswer()
    {
        $this->json('DELETE','api/question/delete/testing/answer/1',[],[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODE0NDQsImV4cCI6MTY1ODM4NTA0NCwibmJmIjoxNjU4MzgxNDQ0LCJqdGkiOiJna0w4cm5zdTR5czRzR1pyIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.GXKLiUUBwelH_TlRM3E51fADj3btn2nol_mF4QdQWwk',
            'Accept' => 'application/json'
        ])->assertStatus(200);
    }

    public function testDeleteFailed()
    {
        $this->json('DELETE','api/question/delete/notfound/answer/100',[],[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODE0NDQsImV4cCI6MTY1ODM4NTA0NCwibmJmIjoxNjU4MzgxNDQ0LCJqdGkiOiJna0w4cm5zdTR5czRzR1pyIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.GXKLiUUBwelH_TlRM3E51fADj3btn2nol_mF4QdQWwk',
            'Accept' => 'application/json'
        ])->assertStatus(401);
    }

}
