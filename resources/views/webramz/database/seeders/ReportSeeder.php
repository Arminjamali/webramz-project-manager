<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ساخت 10 گزارش تستی با استفاده از فاکتوری
        Report::factory()->count(10)->create();
    }
}
