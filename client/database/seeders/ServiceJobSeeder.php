<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Job;

class ServiceJobSeeder extends Seeder
{
    public function run()
    {
        // Define services with their related jobs
        $services = [
            'General Management' => ['CEO', 'Operations Manager', 'Assistant Manager'],
            'Human Resources' => ['HR Manager', 'Recruitment Specialist', 'Payroll Officer'],
            'Finance & Accounting' => ['Chief Financial Officer (CFO)', 'Accountant', 'Cashier'],
            'Food Truck Management' => ['Fleet Manager', 'Truck Supervisor', 'Delivery Coordinator', 'Driver Truck'],  // Added 'Driver Truck' here
            'Supply & Inventory Management' => ['Inventory Manager', 'Purchasing Officer', 'Warehouse Staff'],
            'Marketing & Communication' => ['Marketing Manager', 'Social Media Manager', 'Customer Service Representative'],
            'Chefs & Kitchen Staff' => ['Head Chef', 'Sous Chef', 'Line Cook'],
            'Food Safety & Hygiene' => ['Food Safety Officer', 'Sanitation Worker'],
        ];

        foreach ($services as $serviceName => $jobs) {
            // Insert service
            $service = Service::create(['service' => $serviceName]);

            // Insert related jobs
            foreach ($jobs as $jobName) {
                Job::create([
                    'job' => $jobName,
                    'id_service' => $service->id,
                ]);
            }
        }
    }
}

