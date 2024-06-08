<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class SubmissionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function it_validates_submission_data()
    {
        $response = $this->postJson('/api/submit', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function it_submits_data_and_processes_job()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/submit', $data);
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Submission received and is being processed.']);

        $this->assertDatabaseHas('submissions', $data);
    }
}
