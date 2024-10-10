<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Icon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $category = Category::factory()->create();

        return [
            'category_id' => $category->category_id,
            'category_type' => $category->type,
            'category_logo' => 'logo.png',
            'amount' => 10,
            'memo' => 'watch movie',
            'transaction_date' => $this->faker->date(),
            'user_id' => 1,
            'transaction_id' => '202411202TRSCioieo'
        ];
    }
}
