<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AcademicYear;
use App\Models\AdmissionType;
use App\Models\Branch;
use App\Models\Semester;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name'  =>  'Admin User',
            'password' => bcrypt( 'admin123' ),
        ]);
        $this->command->info('Admin user created.');

        $this->command->warn(PHP_EOL . 'Creating New Role...');
        $adminRole = Role::create(['name' => 'admin']);
        $this->command->info('Role created.');

        $this->command->warn(PHP_EOL . 'Assigning Roles...');
        $adminUser->assignRole($adminRole);
        $this->command->info('Role Assigned.');

        $this->command->warn(PHP_EOL . 'Adding Academic Years...');
        $ay1 = AcademicYear::create(['academic_year'=>'2020-21']);
        $ay2 = AcademicYear::create(['academic_year'=>'2021-22']);
        $ay3 = AcademicYear::create(['academic_year'=>'2022-23']);
        $ay4 = AcademicYear::create(['academic_year'=>'2023-24']);
        $ay5 = AcademicYear::create(['academic_year'=>'2024-25']);
        $this->command->info('Academic Years Added.');

        $this->command->warn(PHP_EOL . 'Adding Admission Types...');
        $at1 = AdmissionType::create(['admission_type'=>'Fresher']);
        $at2 = AdmissionType::create(['admission_type'=>'Lateral Entry']);
        $this->command->info('Admission Types Added.');

        $this->command->warn(PHP_EOL . 'Adding Branches...');
        $b1 = Branch::create(['branch'=>'Civil Engineering','capacity'=>'120']);
        $b2 = Branch::create(['branch'=>'Computer Science & Engineering','capacity'=>'60']);
        $b3 = Branch::create(['branch'=>'Electrical Engineering','capacity'=>'120']);
        $b4 = Branch::create(['branch'=>'Electronics & Telecommunication Engineering','capacity'=>'60']);
        $b5 = Branch::create(['branch'=>'Mechanical Engineering','capacity'=>'120']);
        $this->command->info('Branches Added.');

        $this->command->warn(PHP_EOL . 'Adding Semesters...');
        $sem1 = Semester::create(['semester'=>'1st']);
        $sem2 = Semester::create(['semester'=>'2nd']);
        $sem3 = Semester::create(['semester'=>'3rd']);
        $sem4 = Semester::create(['semester'=>'4th']);
        $sem4 = Semester::create(['semester'=>'5th']);
        $sem4 = Semester::create(['semester'=>'6th']);
        $this->command->info('Semesters Added.');

    }
}
