<?php

namespace Tests\Feature;

use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateQuestionController extends TestCase
{

    public function testUpdateQuestion()
    {
        //need fresh Bearer token and data on database
        $data = [
            'title' => 'edited2',
            'tags' => 'edited2',
            'description' => 'edited2',
        ];

        $this->json('PUT',"api/user/testing/edit/question/2",$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ])->assertStatus(200);

    }

    public function testUpdateQuestionFailed()
    {
        $data = [];

        $this->json('PUT','api/user/testing/edit/question/3',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODE0NDQsImV4cCI6MTY1ODM4NTA0NCwibmJmIjoxNjU4MzgxNDQ0LCJqdGkiOiJna0w4cm5zdTR5czRzR1pyIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.GXKLiUUBwelH_TlRM3E51fADj3btn2nol_mF4QdQWwk',
            'Accept' => 'application/json'
        ])->assertStatus(401);
    }


}
