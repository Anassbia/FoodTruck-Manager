<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        // Ensure Job and Service records exist before assigning them
        $jobId = Job::inRandomOrder()->first()->id ?? 1;  // Fallback to ID 1 if no job is found
        $serviceId = Service::inRandomOrder()->first()->id ?? 1;

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'cin' => $this->faker->unique()->numerify('A########'),
            'phone' => $this->faker->phoneNumber(),
            'image' => $this->faker->imageUrl(),
            'birthday' => $this->faker->date(),
            'salary' => $this->faker->numberBetween(3000, 10000),
            'status' => $this->faker->randomElement([1, 2, 3]),
            'id_job' => $jobId,  // Ensure a valid job ID is assigned
        ];
    }
}
