<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowQuestionController extends TestCase
{
    public function testShowQuestion()
    {

        $this->json('GET','api/question/all?page=1',[],[
            'Accept' => 'application/json'
        ])->assertStatus(200);
    }

}
