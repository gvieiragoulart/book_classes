<?php

namespace Tests\Feature\e2e\Classes;

use Tests\TestCase;

class CreateClassesTest extends TestCase
{
    protected $endpoint = 'api/classes';

    protected $class = [
        'name' => 'Test Class',
        'description' => 'Test Description',
        'start_date' => '11/12/2024',
        'end_date' => '12/12/2024',
        'capacity' => 10,
    ];

    public function testCreateClass()
    {
        $response = $this->postJson($this->endpoint, $this->class);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'message',
            'content' => [
                'id',
                'name',
                'description',
                'start_date',
                'end_date',
                'capacity',
                'bookings'
            ],
        ]);

        $this->assertDatabaseHas('classes', [
            'name' => $this->class['name'],
            'description' => $this->class['description'],
        ]);
    }

    public function testCreateClassWithInvalidData()
    {
        $response = $this->postJson($this->endpoint, [
            'name' => 'Test Class',
            'description' => 'Test Description',
            'start_date' => '11/12/2024',
            'end_date' => '12/12/2024',
            'capacity' => 'invalid',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'capacity'
            ],
        ]);

        $this->assertDatabaseMissing('classes', [
            'name' => $this->class['name'],
            'description' => $this->class['description'],
        ]);
    }

    public function testCreateClassWithInvalidDate()
    {
        $response = $this->postJson($this->endpoint, [
            'name' => 'Test Class',
            'description' => 'Test Description',
            'start_date' => '12-12-2020',
            'end_date' => '12/12/2024',
            'capacity' => 10,
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'start_date'
            ],
        ]);

        $this->assertDatabaseMissing('classes', [
            'name' => $this->class['name'],
            'description' => $this->class['description'],
        ]);
    }   
}