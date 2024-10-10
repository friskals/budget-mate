<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category1 = Category::factory()->create();

        $category2 = Category::factory()->create();

        return [
            'category_id' => $category1->category_id.",".$category2->category_id,
            'limit' => 100000,
            'name' => 'Entertainment',
            'day_of_month' => '1',
            'budget_id' => '1',
            'user_id' => 1
        ];
    }
}
