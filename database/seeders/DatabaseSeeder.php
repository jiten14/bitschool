<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AcademicYear;
use App\Models\AdmissionType;
use App\Models\Branch;
use App\Models\Semester;
use App\Models\FeeType;
use App\Models\ReferalAgent;
use App\Models\Student;
use App\Models\Fee;
use App\Models\Role;
use App\Models\Permission;

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

        $this->command->warn(PHP_EOL . 'Creating Super Admin user...');
        $sadminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name'  =>  'Super Admin',
            'password' => bcrypt( 'admin123' ),
        ]);
        $this->command->info('Super Admin user created.');

        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $adminUser = User::factory()->create([
            'email' => 'test@example.com',
            'name'  =>  'Admin User',
            'password' => bcrypt( 'password' ),
        ]);
        $this->command->info('Admin user created.');

        $this->command->warn(PHP_EOL . 'Creating Account user...');
        $accUser = User::factory()->create([
            'email' => 'account@example.com',
            'name'  =>  'Accountant',
            'password' => bcrypt( 'password' ),
        ]);
        $this->command->info('Account user created.');

        $this->command->warn(PHP_EOL . 'Creating Admission user...');
        $admUser = User::factory()->create([
            'email' => 'admission@example.com',
            'name'  =>  'Admission Incharge',
            'password' => bcrypt( 'password' ),
        ]);
        $this->command->info('Admission user created.');

        $this->command->warn(PHP_EOL . 'Creating View Only user...');
        $voUser = User::factory()->create([
            'email' => 'user@example.com',
            'name'  =>  'User',
            'password' => bcrypt( 'password' ),
        ]);
        $this->command->info('View Only User created.');

        $this->command->warn(PHP_EOL . 'Creating New Role...');
        $sadminRole = Role::create(['name' => 'Superadmin']);
        $adminRole = Role::create(['name' => 'Admin']);
        $accRole = Role::create(['name' => 'Accountant']);
        $admRole = Role::create(['name' => 'Admission In-Charge']);
        $userRole = Role::create(['name' => 'User']);
        $this->command->info('Role created.');

        $this->command->warn(PHP_EOL . 'Creating New Permission...');
        $permission1 = Permission::create(['name' => 'Auth']);
        $permission2 = Permission::create(['name' => 'Setup']);
        $permission3 = Permission::create(['name' => 'Fees']);
        $permission4 = Permission::create(['name' => 'Admission']);
        $permission5 = Permission::create(['name' => 'AuthRole']);
        $permission6 = Permission::create(['name' => 'AuthPermission']);
        $this->command->info('Permission created.');

        $this->command->warn(PHP_EOL . 'Connecting Permission to Role...');
        $sadminRole->givePermissionTo($permission1,$permission2,$permission3,$permission4,$permission5,$permission6);
        $adminRole->givePermissionTo($permission2,$permission3,$permission4);
        $accRole->givePermissionTo($permission3);
        $admRole->givePermissionTo($permission4);
        $userRole->givePermissionTo($permission1);
        $this->command->info('Permission Connected.');

        $this->command->warn(PHP_EOL . 'Assigning Roles...');
        $sadminUser->assignRole($sadminRole);
        $adminUser->assignRole($adminRole);
        $accUser->assignRole($accRole);
        $admUser->assignRole($admRole);
        $voUser->assignRole($userRole);
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

        $this->command->warn(PHP_EOL . 'Adding Fee Types...');
        $ft1 = FeeType::create(['fee_type'=>'Admission Fee']);
        $ft2 = FeeType::create(['fee_type'=>'Examination Fee']);
        $this->command->info('Fee Types Added.');

        $this->command->warn(PHP_EOL . 'Adding some Dummy Referal Agent...');
        $ras = ReferalAgent::factory(20)->create();
        $this->command->info('Dummy Referal Agent Added.');

        $this->command->warn(PHP_EOL . 'Adding some Dummy Student...');
        $student = Student::factory(20)->create();
        $this->command->info('Dummy Student Added.');

        $this->command->warn(PHP_EOL . 'Adding some Dummy Fees...');
        $fee = Fee::factory(10)->create();
        $this->command->info('Dummy Fees Added.');

    }
}
