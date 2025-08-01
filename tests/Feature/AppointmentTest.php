<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\User\Models\User;
use App\Domains\Appointment\Models\Appointment;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can successfully book an appointment.
     */
    public function test_user_can_book_appointment()
    {
        // Create a test user
        $user = User::factory()->create();

        // Create a healthcare professional
        $professional = HealthcareProfessional::factory()->create();

        // Act as the user and attempt to book an appointment
        $response = $this->actingAs($user, 'api')->postJson('/api/appointments', [
            'healthcare_professional_id' => $professional->id,
            'appointment_date' => now()->addDay()->toDateString(),
            'appointment_time' => '10:00'
        ]);

        // Assert that the response is successful and contains expected structure
        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'user_id']);
    }

    /**
     * Test that a user can view their list of appointments.
     */
    public function test_user_can_view_appointments()
    {
        // Create a test user
        $user = User::factory()->create();

        // Create an appointment for this user
        Appointment::factory()->create(['user_id' => $user->id]);

        // Act as the user and fetch their appointments
        $response = $this->actingAs($user, 'api')->getJson('/api/appointments');

        // Assert that the response is successful and returns a list of appointments
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     ['id', 'appointment_date']
                 ]);
    }
}
