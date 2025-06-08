<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name'            => $this->faker->company,
            'type'            => $this->faker->randomElement(['store', 'company']),
            'plan'            => $this->faker->randomElement(['basic', 'pro', 'vip', 'elite']),
            'lang'            => $this->faker->randomElement([1, 2, 3]),
            'figma_count'     => $this->faker->numberBetween(0, 5),
            'days'            => $this->faker->numberBetween(10, 90),
            'delivery_date'   => $this->faker->dateTimeBetween('+10 days', '+60 days'),
            'start_date'      => $this->faker->dateTimeBetween('-30 days', 'now'),
            'sign_date'       => $this->faker->dateTimeBetween('-40 days', '-10 days'),
            'ticket'          => $this->faker->url,
            'demo'            => $this->faker->url,
            'figma'           => $this->faker->url,
            'domain'          => $this->faker->domainName,
            'status'          => $this->faker->randomElement([
                'design', 'development', 'demo_delivery',
                'waiting_content', 'reviewing', 'applying_edits',
                'post_edit_delivery', 'secondary_language',
                'training_video', 'final_delivery'
            ]),
            'design_status'   => $this->faker->randomElement(['design', 'design_review', 'counseling', 'finished']),
            'designer_id'     => User::factory(),       // یا مقدار عددی دستی برای تست سریع
            'developer_id'    => User::factory(),
            'customer_id'     => Customer::factory(),   // فرض بر اینه که مدل Customer داری
        ];
    }
}
