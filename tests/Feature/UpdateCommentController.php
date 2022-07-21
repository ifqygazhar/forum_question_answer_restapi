<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCommentController extends TestCase
{
    public function testUpdateComment()
    {
        //need fresh Bearer token and data on database
        $data = [
          'comment' => 'editedtesting',
        ];

        $this->json('PUT','api/question/edit/testing/comment/1',$data,[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ])->assertStatus(200);

    }

    public function testFailedUpdateComment()
    {
        $this->json('PUT','api/question/edit/testing/comment/1',[],[
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3VzZXIvbG9naW4iLCJpYXQiOjE2NTgzODcyMjUsImV4cCI6MTY1ODM5MDgyNSwibmJmIjoxNjU4Mzg3MjI1LCJqdGkiOiIydmtQMjF4clVJR3ZFMERnIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.XXqMPWmiuf01To15ScXdtCUppLlQTu9OJrYGYM5veQE',
            'Accept' => 'application/json'
        ])->assertStatus(400);

    }


}
