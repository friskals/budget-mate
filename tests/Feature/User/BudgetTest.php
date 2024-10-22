<?php

namespace Tests\Feature\User;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetTest extends UserBaseTestCase
{
    const ENDPOINT = '/budget';

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

        $this->post(self::ENDPOINT, $budget_request)->assertRedirect(self::ENDPOINT)->assertRedirect(self::ENDPOINT);

        $this->assertDatabaseHas('budgets', [
            'name' => 'Education',
            'limit' => 100000,
            'day_of_month' => 1
        ]);

        $this->assertDatabaseHas('budget_categories', [
            'category_id' => $category->category_id
        ]);

    }

    public function test_update_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $budget = Budget::factory()->create();

        $updated_budget['name'] = $budget->name.' Update';

        $this->put(self::ENDPOINT.'/'.$budget->budget_id, $updated_budget);

        $this->assertDatabaseHas('budgets', ['budget_id'=> $budget->budget_id, 'name'=> $updated_budget['name']]);
    }

    public function test_delete_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $budget = Budget::factory()->create();

        $this->delete(self::ENDPOINT.'/'.$budget->budget_id);

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

        $this->post(self::ENDPOINT, $budget_request)->assertRedirect(self::ENDPOINT);

        $this->get(self::ENDPOINT)->assertSee('Education');
    }

    public function test_view_create_budget_success(): void
    {
        $this->withoutExceptionHandling();

        $this->get(self::ENDPOINT.'/create')->assertOk();
    }

    public function test_view_edit_budget_success(): void
    {
        $budget = Budget::factory()->create();

        $this->get(self::ENDPOINT.'/edit/'.$budget->budget_id)->assertOk();
    }
}
