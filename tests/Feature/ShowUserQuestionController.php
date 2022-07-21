<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowUserQuestionController extends TestCase
{
    public function testShowUserQuestion()
    {
        $this->json('GET','api/question/2/edited',[],[
            'Accept' => 'application/json'
        ])->assertStatus(200);
    }

}
