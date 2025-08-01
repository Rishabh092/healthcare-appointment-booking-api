<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Domains\Appointment\Services\AppointmentService;
use App\Domains\Appointment\Repositories\AppointmentRepository;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Mockery;

class AppointmentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_book_an_appointment()
    {
        $repo = Mockery::mock(AppointmentRepository::class);

        $user = User::factory()->create();
        $professional = HealthcareProfessional::factory()->create();

        $data = [
            'user_id' => $user->id,
            'healthcare_professional_id' => $professional->id,
            'appointment_date' => now()->addDays(1)->toDateString(),
            'appointment_time' => '10:00',
            'status' => 'booked',
        ];

        $repo->shouldReceive('create')->once()->with($data)->andReturn((object)$data);

        $service = new AppointmentService($repo);
        $appointment = $service->book($data,$user);

        $this->assertEquals($data['user_id'], $appointment->user_id);
    }
}
