<?php

namespace Database\Factories;

use App\Models\Figma;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class FigmaFactory extends Factory
{
    protected $model = Figma::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->word, // یا faker->sentence برای نام‌های پیچیده‌تر
            'date'        => $this->faker->dateTimeThisYear(),
            'project_id'  => Project::factory(),  // ایجاد یک پروژه تصادفی از فاکتوری پروژه
        ];
    }
}
