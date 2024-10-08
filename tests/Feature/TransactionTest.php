<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Icon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    private const ENDPOINT = '/transaction';

    public function test_store_transaction_successfully(): void
    {
        $this->withoutExceptionHandling();

        $icon = Icon::factory()->create();

        $category = Category::create([
            'icon_id' => $icon->icon_id,
            'type' => 'expense',
            'name' => 'Learning',
            'user_id' => '1',
            'category_id'=>'1212121'
        ]);


        $request_data = [
            'category_id' => $category->category_id,
            'amount' => 5000.0,
            'memo' => 'book',
            'transaction_date' => '2024-09-09'
        ];

        $this->post(self::ENDPOINT, $request_data);

        $this->assertDatabaseHas('transactions',$request_data);
    }

    /**
     * TODO
     * - test_detail_transaction_successfully
     * - test_view_transaction
     * - test_delete_transaction
     * - test_update_detail -> all field, coba pake fresh
     * - scenario update tanggal di budget usage beda lagi
     */
}
