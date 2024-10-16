<?php

namespace Tests\Feature\User;

use App\Models\Account;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends UserBaseTestCase
{
    use RefreshDatabase;
    private const ENDPOINT = '/transaction';

    public function test_store_transaction_successfully(): void
    {
        $this->withoutExceptionHandling();

        $icon = Icon::factory()->create();

        $account = Account::factory()->create();

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
            'transaction_date' => '2024-09-09',
            'account_id' => $account->account_id
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

    public function test_update_transaction_successfully(){
        $this->withoutExceptionHandling();

        $transaction = Transaction::factory()->create();

        $category = Category::factory()->create();

        $account = Account::factory()->create();

        $transaction_new_data = [
            'category_id' => $category->category_id,
            'amount' => 20,
            'memo' => 'watch movie update',
            'transaction_date' => now(),
            'account_id' => $account->account_id
        ];

        $this->put(self::ENDPOINT.'/'.$transaction->transaction_id, $transaction_new_data);

        $transaction->refresh();

        $this->assertEquals($transaction_new_data['category_id'], $transaction['category_id']);
        $this->assertEquals($transaction_new_data['amount'], $transaction['amount']);
        $this->assertEquals($transaction_new_data['memo'], $transaction['memo']);
        $this->assertEquals($transaction_new_data['transaction_date'], $transaction['transaction_date']);
        $this->assertEquals($transaction_new_data['account_id'], $transaction['account_id']);

    }

    public function test_detail_transaction_successfully(){

        $transaction = Transaction::factory()->create();

        $this->get(self::ENDPOINT.'/'.$transaction->transaction_id)
            ->assertSee([$transaction->transaction_id, $transaction->memo]);
    }

    public function test_delete_transaction_successfully(){

        $transaction = Transaction::factory()->create();

        $this->delete(self::ENDPOINT."/".$transaction->transaction_id);

        $this->assertDatabaseMissing('transactions', ['transaction_id', $transaction->transaction_id]);
    }
}
