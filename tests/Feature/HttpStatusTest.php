<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class HttpStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function testIndexStatus() 
     {
        $response = $this->post('/api/category', [
            'name'  => 'c',
            'slug'  => 'fd',
        ]);

        print_r($response);
        $response->assertStatus(200);
     }
}


