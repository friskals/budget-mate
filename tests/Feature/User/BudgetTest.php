<?php

namespace Tests\Feature\User;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetTest extends UserBaseTestCase
{
    const BUDGET_ENDPOINT = '/budget';

    use RefreshDatabase;

    public function test_store_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $budget_request = [
            'name' => 'Education',
            'limit' => 100000,
            'category_id' => $category->category_id,
            'day_of_month' => 1
        ];

        $this->post(self::BUDGET_ENDPOINT, $budget_request)->assertRedirect(self::BUDGET_ENDPOINT);

        $this->assertDatabaseHas('budgets', [
            'name' => 'Education',
            'limit' => 100000,
            'day_of_month' => 1
        ]);

        $this->assertDatabaseHas('budget_categories', [
            'category_id' => $category->category_id
        ]);

    }

    public function test_show_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $budget = Budget::factory()->create();

        $this->get(self::BUDGET_ENDPOINT.'/'.$budget->budget_id)->assertSee($budget->name);
    }

    public function test_update_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $budget = Budget::factory()->create();

        $updated_budget['name'] = $budget->name.' Update';

        $this->put(self::BUDGET_ENDPOINT.'/'.$budget->budget_id, $updated_budget);

        $this->assertDatabaseHas('budgets', ['budget_id'=> $budget->budget_id, 'name'=> $updated_budget['name']]);
    }

    public function test_delete_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $budget = Budget::factory()->create();

        $this->delete(self::BUDGET_ENDPOINT.'/'.$budget->budget_id);

        $this->assertDatabaseMissing('budgets', ['budget_id' => $budget->budget_id]);
    }

    public function test_index_success(): void
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $budget_request = [
            'name' => 'Education',
            'limit' => 100000,
            'category_id' => $category->category_id,
            'day_of_month' => 1
        ];

        $this->post(self::BUDGET_ENDPOINT, $budget_request)->assertRedirect(self::BUDGET_ENDPOINT);

        $this->get(self::BUDGET_ENDPOINT)->assertSee('Education');
    }
}
