<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {

        $roleId = Role::inRandomOrder()->first()->id ?? 1;
        $employeeId = Employee::inRandomOrder()->first()->id ?? 2;


        return [
            'username' => $this->faker->userName(),
            'password' => bcrypt('password'), // You should hash the password
            'status' => $this->faker->randomElement([1, 2]),
            'id_role' => $roleId,  // Ensure id_role is set
            'id_employee' => $employeeId, // Random employee ID
        ];
    }
}
