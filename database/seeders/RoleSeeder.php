<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enum\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $role_enum) {
            Role::create([
                'name' => $role_enum->name,
                'description' => $role_enum->getDescription()
            ]);
        }
    }
}
