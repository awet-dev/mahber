<?php

namespace Database\Seeders;

use App\Models\Child;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChildSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Child::factory(10)->unverified()->create();
    }
}
