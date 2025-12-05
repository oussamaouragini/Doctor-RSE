<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            'Cardiology', 'Dermatology', 'Pediatrics', 'Neurology',
            'Psychiatry', 'General Medicine', 'Dentistry', 'Ophthalmology'
        ];

        for ($i = 1; $i <= 10; $i++) {
            $specialty = $specialties[array_rand($specialties)];
            Doctor::updateOrCreate(
                [
                    'email' => "doctor$i@example.com"
                ],
                [
                    'name' => "Doctor $i",
                    'speciality' => $specialty,
                    'specialty' => $specialty,
                    'address' => "City Center Block $i",
                    'is_eco_friendly' => rand(0, 1),
                    'is_local_business' => rand(0, 1),
                    'is_accessible' => rand(0, 1),
                    'rse_score' => rand(50, 100),
                ]
            );
        }
    }
}
