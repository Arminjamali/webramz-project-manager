<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ساخت 10 کاربر تستی با استفاده از فاکتوری
        User::factory()->count(10)->create();
    }
}
