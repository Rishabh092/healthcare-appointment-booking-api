<?php

namespace Tests\Feature\HealthcareProfessional;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;

class HealthcareProfessionalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the API returns a list of healthcare professionals.
     */
    public function test_can_list_healthcare_professionals()
    {
        // Create 3 professionals
        HealthcareProfessional::factory()->count(3)->create();

        // Send GET request to the professionals listing endpoint
        $response = $this->getJson('/api/professionals');

        // Assert response has 200 OK status and contains 3 items
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /**
     * Test the API returns an empty array when no professionals exist.
     */
    public function test_healthcare_professionals_list_returns_empty_array_when_none_exist()
    {
        // No professionals created

        // Send GET request
        $response = $this->getJson('/api/professionals');

        // Assert status is OK and the data array is empty
        $response->assertStatus(200)
                 ->assertJson([
                     'data' => []
                 ]);
    }

    /**
     * Test the structure of the healthcare professionals list response.
     */
    public function test_healthcare_professional_list_response_structure()
    {
        // Create one professional
        $professional = HealthcareProfessional::factory()->create();

        // Send GET request
        $response = $this->getJson('/api/professionals');

        // Assert correct structure for each professional entry
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         [
                             'id',
                             'name',
                             'specialization',
                             'email',       // Make sure your model and resource return this field
                             'created_at',
                             'updated_at',
                         ]
                     ]
                 ]);
    }
}
