<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class UserBaseTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    public function signIn($user = null)
    {
        $user = $user ?? User::factory()->create();

        $this->be($user);

        return $user;
    }
}
