<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $doctors = Doctor::all();

        if ($users->isEmpty() || $doctors->isEmpty()) {
            $this->command->warn('No users or doctors found. Please run UserSeeder and DoctorSeeder first.');
            return;
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                Appointment::create([
                    'user_id' => $user->id,
                    'doctor_id' => $doctors->random()->id,
                    'date' => Carbon::now()->addDays(rand(1, 30)),
                    'time' => Carbon::now()->setTime(rand(8, 17), rand(0, 59)),
                    'status' => ['pending', 'confirmed', 'completed', 'cancelled'][rand(0, 3)],
                    'is_remote' => rand(0, 1) == 1,
                ]);
            }
        }
    }
}

