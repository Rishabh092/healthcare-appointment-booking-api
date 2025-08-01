<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domains\HealthcareProfessional\Services\HealthcareProfessionalService;
use App\Domains\HealthcareProfessional\Repositories\HealthcareProfessionalRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class HealthcareProfessionalServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_professionals()
    {
        // Mock the repository
        $repo = Mockery::mock(HealthcareProfessionalRepository::class);

        // Expected mock return data
        $expected = [
            ['id' => 1, 'name' => 'Dr. Aarti Sharma', 'specialization' => 'Cardiologist'],
            ['id' => 2, 'name' => 'Dr. Rajeev Kumar', 'specialization' => 'Neurologist'],
        ];

        // Define behavior of the mocked 'getAll' method
        $repo->shouldReceive('getAll')->once()->andReturn($expected);

        // Inject mock into service
        $service = new HealthcareProfessionalService($repo);

        // Call the updated method
        $list = $service->getAll();

        // Assertions
        $this->assertCount(2, $list);
        $this->assertEquals('Dr. Aarti Sharma', $list[0]['name']);
        $this->assertEquals('Neurologist', $list[1]['specialization']);
    }

    // Cleanup Mockery
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
