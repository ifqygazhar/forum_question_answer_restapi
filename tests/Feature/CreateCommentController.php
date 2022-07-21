<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCommentController extends TestCase
{
    //need fresh bearer token
    public function testCreateComment()
    {
        $data = [
          'comment' => 'testing',
        ];

        $this->json('POST','api/question/2/answer/1/comment/testing',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ])->assertStatus(201);

    }

    public function testFailedCreateComment()
    {
        $this->json('POST','api/question/2/answer/1/comment/testing',[],[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ])->assertStatus(400);
    }


}
