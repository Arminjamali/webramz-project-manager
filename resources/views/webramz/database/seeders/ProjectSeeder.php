<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ساخت 10 پروژه فرضی با استفاده از فکتوری
        Project::factory()->count(10)->create();
    }
}
