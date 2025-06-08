<?php

namespace Database\Factories;

use App\Models\Log;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition(): array
    {
        return [
            'title'     => $this->faker->sentence,
            'date'      => $this->faker->dateTimeThisYear(),
            'project_id'=> Project::factory(),  // ایجاد یک پروژه تصادفی از فاکتوری پروژه
            'user_id'   => User::factory(),     // ایجاد یک کاربر تصادفی از فاکتوری کاربر
        ];
    }
}
