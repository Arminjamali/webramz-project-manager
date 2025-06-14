<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ساخت 10 مشتری تستی با استفاده از فاکتوری
        Customer::factory()->count(10)->create();
    }
}
