<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateAnswerController extends TestCase
{
    //need fresh bearer token
    public function testCreateAnswer()
    {
        $data = [
            'answer' => 'testinganswer'
        ];

        $this->json('POST','api/question/2/answer/testing',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODE0NDQsImV4cCI6MTY1ODM4NTA0NCwibmJmIjoxNjU4MzgxNDQ0LCJqdGkiOiJna0w4cm5zdTR5czRzR1pyIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.GXKLiUUBwelH_TlRM3E51fADj3btn2nol_mF4QdQWwk',
            'Accept' => 'application/json'
        ])->assertStatus(201);
    }

    public function testFailedCreateAnswer()
    {
        $data = [];

        $this->json('POST','api/question/1/answer/notfound',$data,['Accept' => 'application/json'])->assertStatus(404);

    }


}
