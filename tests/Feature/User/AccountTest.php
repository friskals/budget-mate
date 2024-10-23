<?php

namespace Tests\Feature\User;

use App\Models\Account;
use App\Models\Icon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTest extends UserBaseTestCase
{
    const ACCOUNT_ENDPOINT = '/account';

    use RefreshDatabase;

    public function test_store_account_success(): void
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $icon = Icon::factory()->create();

        $store_request = [
            'name' => 'BCA',
            'icon_id' => $icon->icon_id
        ];

        $this->post(self::ACCOUNT_ENDPOINT, $store_request)->assertRedirect(self::ACCOUNT_ENDPOINT);

        $this->assertDatabaseHas('accounts', $store_request);
    }

    public function test_show_account_success(): void
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $account = Account::factory()->create();

        $this->get(self::ACCOUNT_ENDPOINT.'/'.$account->account_id)->assertSee($account->name);
    }

    public function test_update_account_success(): void
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $account = Account::factory()->create();

        $updated_account['name'] = $account->name.' Update';

        $this->put(self::ACCOUNT_ENDPOINT.'/'.$account->account_id, $updated_account);

        $this->assertDatabaseHas('accounts', ['account_id'=> $account->account_id, 'name'=> $updated_account['name']]);
    }

    public function test_delete_account_success(): void
    {
        $this->withoutExceptionHandling();

        $account = Account::factory()->create();

        $this->delete(self::ACCOUNT_ENDPOINT.'/'.$account->account_id);

        $this->assertDatabaseMissing('accounts', ['account_id' => $account->account_id]);
    }

    public function test_view_create_account_success(): void
    {
        $this->withoutExceptionHandling();

        $this->get(self::ACCOUNT_ENDPOINT.'/create')->assertSeeText('Account');
    }

    public function test_view_edit_account_success(): void
    {
        $account = Account::factory()->create();

        $this->get(self::ACCOUNT_ENDPOINT.'/edit/'.$account->budget_id)->assertSeeText(['Account', $account->name]);
    }
}
