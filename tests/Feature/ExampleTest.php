<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHome()
    {
        $response = $this->get('/');
        $this->assertContains($response->getStatusCode(), array(200,302));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStyleguide()
    {
        $response = $this->get(route('styleguide'));
        $response->assertStatus(200);
    }
}
