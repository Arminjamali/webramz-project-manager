<?php

namespace Database\Seeders;

use App\Models\Figma;
use Illuminate\Database\Seeder;

class FigmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ساخت 10 فایل Figma با استفاده از فاکتوری
        Figma::factory()->count(10)->create();
    }
}
