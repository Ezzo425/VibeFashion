<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_new_visitors_are_sent_to_registration(): void
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('register');
    }
}
