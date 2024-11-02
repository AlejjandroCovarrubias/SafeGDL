<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSum()
    {
        $math = new Math();
        $this->assertEquals(4, $math->sum(2, 2));
        $this->assertEquals(10, $math->sum(7, 3));
        $this->assertEquals(-1, $math->sum(2, -3));
    }
}
