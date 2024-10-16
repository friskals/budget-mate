<?php

namespace Tests\Feature\User;

use App\Models\Account;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetUsageTest extends UserBaseTestCase
{
    use RefreshDatabase;
    private const BUDGET_USAGE_ENDPOINT = '/budget/usage';
    /**
     * A basic feature test example.
     */
    public function test_index_budget_usage_successfully(): void
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $budget_data = [  'category_id' => $category->category_id,
            'limit' => 100000,
            'name' => 'Entertainment',
            'day_of_month' => '1',
            'budget_id' => '1',
            'user_id' => 1
        ];

        $budget = Budget::create($budget_data);

        BudgetCategory::create([
            'budget_id' => $budget_data['budget_id'],
            'category_id' => $category->category_id
        ]);

        $account = Account::factory()->create();

        Transaction::create([
            'category_id' => $category->category_id,
            'category_type' => $category->type,
            'category_logo' => 'logo.png',
            'amount' => 20000.0,
            'memo' => "beli kopi kenangan",
            'transaction_date' => '2024-10-02',
            'user_id' => 1,
            'transaction_id' => '202411202TRSCioieo',
            'account_id' => $account->account_id
        ]);

        $this->post(self::BUDGET_USAGE_ENDPOINT, [
            'end_date' => '2024-10-31'
        ])->assertSee($budget->name,'20000.0');
    }

    public function test2_index_budget_usage_successfully(): void
    {
        $category = Category::factory()->create();

        $budget_data = [  'category_id' => $category->category_id,
            'limit' => 100000,
            'name' => 'Entertainment',
            'day_of_month' => '5',
            'budget_id' => '1',
            'user_id' => 1
        ];

        Budget::create($budget_data);

        $account = Account::factory()->create();

         Transaction::create([
            'category_id' => $category->category_id,
            'category_type' => $category->type,
            'category_logo' => 'logo.png',
            'amount' => 20000.0,
            'memo' => "beli kopi kenangan",
            'transaction_date' => '2024-10-02',
            'user_id' => 1,
            'transaction_id' => '202411202TRSCioieo',
            'account_id' => $account->account_id
        ]);

        $this->post(self::BUDGET_USAGE_ENDPOINT, [
            'start_date' => '2024-10-01',
            'end_date' => '2024-10-31'
        ])->assertDontSee('20000.0', $budget_data['name']);

    }
}
