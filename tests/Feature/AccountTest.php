<?php

namespace Tests\Feature;

use App\Models\Icon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    const ACCOUNT_ENDPOINT = '/account';

    use RefreshDatabase;

    public function test_store_account_success(): void
    {
        $this->withoutExceptionHandling();

        $icon = Icon::factory()->create();

        $store_request = [
            'name' => 'BCA',
            'icon_id' => $icon->icon_id,
            'user_id' => 1
        ];

        $this->post(self::ACCOUNT_ENDPOINT, $store_request);

        $this->assertDatabaseHas('accounts', $store_request);
    }

    public function test_show_account_success(): void
    {

    }

    public function test_update_account_success(): void
    {

    }

    public function test_delete_account_success(): void
    {

    }
}
