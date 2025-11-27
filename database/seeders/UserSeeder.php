<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function createAdminUser()
    {
        $user = User::create([
            'name' => 'Admin',
            'uuid' => Str::uuid(),
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rahasia'),
        ]);
        $user->assignRole('admin');
    }

    public function createMentorUser()
    {
        $user = User::create([
            'name' => 'Abah Budi',
            'uuid' => Str::uuid(),
            'email' => 'abahbudi@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rahasia'),
        ]);

        Mentor::create([
            'user_id' => $user->id,
            'division_id' => 1,
            'employee_number' => 'EMP123456',
            'phone' => '6285157267750',
        ]);

        $user->assignRole('mentor');
    }

    public function createStudentUser()
    {
        $user = User::create([
            'name' => 'Siswa Joko',
            'uuid' => Str::uuid(),
            'email' => 'siswajoko@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('rahasia'),
        ]);

        Student::create([
            'user_id' => $user->id,
            'student_number' => 'STU123456',
            'institution' => 'Universitas Contoh',
            'major' => 'Teknik Informatika',
            'phone' => '6285157267750',
            'address' => 'Jl. Contoh No. 123, Kota Contoh',
        ]);

        $user->assignRole('student');
    }



    public function run(): void
    {
        $this->createAdminUser();
        $this->createMentorUser();
        $this->createStudentUser();
    }
}
