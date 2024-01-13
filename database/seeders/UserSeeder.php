<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enum\RoleEnum;
use Illuminate\Database\Seeder;
use App\Repositories\RoleRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedAdminUser();
        $this->seedFinanceUser();
        $this->seedTeacherUser();
        $this->seedUsers();
    }

    private function seedAdminUser(): void
    {
        $role = RoleRepository::getByName(RoleEnum::ADMIN);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com'
        ])->roles()->save($role);
    }

    private function seedFinanceUser(): void
    {
        $role = RoleRepository::getByName(RoleEnum::FINANCE);

        User::factory()->create([
            'name' => 'Finance User',
            'email' => 'finance@gmail.com'
        ])->roles()->save($role);
    }

    private function seedTeacherUser(): void
    {
        $role = RoleRepository::getByName(RoleEnum::TEACHER);

        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com'
        ])->roles()->save($role);
    }

    private function seedUsers(): void
    {
        User::factory(7)
            ->unverified()
            ->create();
    }
}
