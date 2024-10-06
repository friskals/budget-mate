<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => '202411202CTRYioieo',
            'type' => 'expense',
            'name' => 'Entertainment',
            'user_id' => '1',
            'icon_id' => '1'
        ];
    }
}
