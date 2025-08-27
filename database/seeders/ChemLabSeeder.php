<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChemLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@chemlab.ui.ac.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
            'status' => 'active',
            'phone' => '+62-21-7270032',
            'department' => 'Chemical Engineering',
            'faculty' => 'Faculty of Engineering',
            'approved_at' => now(),
            'approved_by' => 1,
        ]);

        // Create Head of Lab Users
        $headOfLabs = [
            [
                'name' => 'Prof. Dr. Ir. Ahmad Fauzi',
                'email' => 'ahmad.fauzi@ui.ac.id',
                'department' => 'Chemical Engineering',
                'assigned_labs' => [1, 2],
            ],
            [
                'name' => 'Dr. Ir. Siti Nurhasanah, M.T.',
                'email' => 'siti.nurhasanah@ui.ac.id',
                'department' => 'Chemical Engineering',
                'assigned_labs' => [3, 4],
            ],
        ];

        foreach ($headOfLabs as $headData) {
            User::create([
                'name' => $headData['name'],
                'email' => $headData['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'head_of_lab',
                'status' => 'active',
                'phone' => '+62-21-' . random_int(7270000, 7270999),
                'department' => $headData['department'],
                'faculty' => 'Faculty of Engineering',
                'assigned_labs' => $headData['assigned_labs'],
                'approved_at' => now(),
                'approved_by' => $admin->id,
            ]);
        }

        // Create Lab Assistant Users
        $labAssistants = [
            [
                'name' => 'Budi Santoso, S.T.',
                'email' => 'budi.santoso@ui.ac.id',
                'assigned_labs' => [1],
            ],
            [
                'name' => 'Rina Kartika, S.T.',
                'email' => 'rina.kartika@ui.ac.id',
                'assigned_labs' => [2],
            ],
            [
                'name' => 'Dedi Kurniawan, S.T.',
                'email' => 'dedi.kurniawan@ui.ac.id',
                'assigned_labs' => [3],
            ],
            [
                'name' => 'Maya Sari, S.T.',
                'email' => 'maya.sari@ui.ac.id',
                'assigned_labs' => [4],
            ],
        ];

        foreach ($labAssistants as $assistantData) {
            User::create([
                'name' => $assistantData['name'],
                'email' => $assistantData['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'lab_assistant',
                'status' => 'active',
                'phone' => '+62-21-' . random_int(7270000, 7270999),
                'department' => 'Chemical Engineering',
                'faculty' => 'Faculty of Engineering',
                'assigned_labs' => $assistantData['assigned_labs'],
                'approved_at' => now(),
                'approved_by' => $admin->id,
            ]);
        }

        // Create Lecturer Users
        $lecturers = [
            'Dr. Ir. Bambang Suryanto, M.T.',
            'Dr. Indah Permatasari, S.T., M.T.',
            'Prof. Dr. Ir. Agus Wahyudi',
            'Dr. Ir. Fitri Handayani, M.T.',
        ];

        foreach ($lecturers as $lecturerName) {
            $email = strtolower(str_replace([' ', '.', ','], ['', '', ''], explode(' ', $lecturerName)[2] ?? $lecturerName)) . '@ui.ac.id';
            User::create([
                'name' => $lecturerName,
                'email' => $email,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'lecturer',
                'status' => 'active',
                'phone' => '+62-21-' . random_int(7270000, 7270999),
                'department' => 'Chemical Engineering',
                'faculty' => 'Faculty of Engineering',
                'approved_at' => now(),
                'approved_by' => $admin->id,
            ]);
        }

        // Create Student Users
        $students = [
            ['name' => 'John Doe', 'student_id' => '1906123456'],
            ['name' => 'Jane Smith', 'student_id' => '1906123457'],
            ['name' => 'Michael Johnson', 'student_id' => '1906123458'],
            ['name' => 'Sarah Wilson', 'student_id' => '1906123459'],
            ['name' => 'David Brown', 'student_id' => '1906123460'],
        ];

        foreach ($students as $studentData) {
            User::create([
                'name' => $studentData['name'],
                'email' => strtolower(str_replace(' ', '.', $studentData['name'])) . '@student.ui.ac.id',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'student_id' => $studentData['student_id'],
                'role' => 'student',
                'status' => 'active',
                'phone' => '+62-8' . random_int(1000000000, 9999999999),
                'department' => 'Chemical Engineering',
                'faculty' => 'Faculty of Engineering',
                'approved_at' => now(),
                'approved_by' => $admin->id,
            ]);
        }

        // Create Laboratories
        $laboratories = [
            [
                'name' => 'Analytical Chemistry Laboratory',
                'code' => 'ACL-001',
                'description' => 'State-of-the-art analytical chemistry laboratory equipped with modern instruments for qualitative and quantitative analysis.',
                'location' => 'Building A, Floor 2',
                'capacity' => 30,
            ],
            [
                'name' => 'Organic Chemistry Laboratory',
                'code' => 'OCL-002',
                'description' => 'Specialized laboratory for organic synthesis and characterization with fume hoods and safety equipment.',
                'location' => 'Building A, Floor 3',
                'capacity' => 25,
            ],
            [
                'name' => 'Physical Chemistry Laboratory',
                'code' => 'PCL-003',
                'description' => 'Advanced laboratory for thermodynamics, kinetics, and spectroscopy experiments.',
                'location' => 'Building B, Floor 1',
                'capacity' => 20,
            ],
            [
                'name' => 'Process Engineering Laboratory',
                'code' => 'PEL-004',
                'description' => 'Industrial-scale equipment for unit operations and process simulation.',
                'location' => 'Building C, Floor 1',
                'capacity' => 35,
            ],
        ];

        $operatingHours = [
            'monday' => ['start' => '08:00', 'end' => '17:00'],
            'tuesday' => ['start' => '08:00', 'end' => '17:00'],
            'wednesday' => ['start' => '08:00', 'end' => '17:00'],
            'thursday' => ['start' => '08:00', 'end' => '17:00'],
            'friday' => ['start' => '08:00', 'end' => '17:00'],
            'saturday' => ['start' => '09:00', 'end' => '15:00'],
            'sunday' => null,
        ];

        foreach ($laboratories as $labData) {
            Laboratory::create([
                'name' => $labData['name'],
                'code' => $labData['code'],
                'description' => $labData['description'],
                'location' => $labData['location'],
                'capacity' => $labData['capacity'],
                'operating_hours' => $operatingHours,
                'contact_person' => 'Lab Coordinator',
                'contact_email' => strtolower(str_replace(' ', '.', explode(' ', $labData['name'])[0])) . '@ui.ac.id',
                'contact_phone' => '+62-21-' . random_int(7270000, 7270999),
                'rules' => "Laboratory Safety Rules:\n1. Always wear safety goggles and lab coat\n2. No eating or drinking in the laboratory\n3. Report all accidents immediately\n4. Follow proper waste disposal procedures\n5. Clean workspace after each use",
                'status' => 'active',
            ]);
        }

        // Create Equipment for each laboratory
        Laboratory::all()->each(function (Laboratory $lab) {
            // Create 15-25 equipment items per lab
            Equipment::factory()
                ->count(random_int(15, 25))
                ->for($lab)
                ->create();
        });

        // Create additional random users for testing
        User::factory(50)->create();
        
        echo "ChemLab database seeded successfully!\n";
        echo "Admin login: admin@chemlab.ui.ac.id / password\n";
        echo "Sample student login: john.doe@student.ui.ac.id / password\n";
        echo "Sample lecturer login: bambangsuryanto@ui.ac.id / password\n";
    }
}