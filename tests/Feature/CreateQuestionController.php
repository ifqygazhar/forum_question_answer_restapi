<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateQuestionController extends TestCase
{
    //need fresh bearer token
    public function testQuestion()
    {
        $data = [
          'title' => 'abcdef',
          'tags' => 'mysql',
          'description' => 'code nya salah',
        ];

        $this->json('POST','api/user/testing/question',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ])->assertStatus(201);
    }

    public function testQuestionFailed()
    {
        $data = [];

        $this->json('POST','api/user/testing/question',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzNjQ2NDQsImV4cCI6MTY1ODM2ODI0NCwibmJmIjoxNjU4MzY0NjQ0LCJqdGkiOiJLbE1UOE5zTkdQazZpUml5Iiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Baqlk142s8s77HyxExzzk4IQH9g3ysO8oozRtraq7S4' ,
            'Accept' => 'application/json'
        ])->assertStatus(400);
    }


}
