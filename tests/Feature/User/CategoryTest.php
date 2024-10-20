<?php

namespace Tests\Feature\User;

use App\Models\Category;
use App\Models\Icon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class CategoryTest extends UserBaseTestCase
{
    use RefreshDatabase;

    private const ENDPOINT = '/category';

    /**
     * A basic feature test example.
     */
    public function test_add_category_success(): void
    {
        $this->withoutExceptionHandling();

        $icon = Icon::factory()->create();

        $store_request =  [
            'name' => 'Entertainment',
            'icon_id' => $icon->icon_id,
            'type' => 'expense'
        ];

        $this->post(self::ENDPOINT, $store_request);

        $this->get(self::ENDPOINT, $store_request)
            ->assertSee('Entertainment');
    }

    public function test_show_detail_success()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->get(self::ENDPOINT.'/'.$category->category_id)
            ->assertSee($category->id, $category->name);
    }

    public function test_update_success()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $updated_category = [
            'name' => $category->name. " Update"
        ];

        $this->put(self::ENDPOINT.'/'.$category->category_id, $updated_category);

        $this->assertDatabaseHas('categories', ['category_id'=>$category->category_id, 'name'=>$updated_category['name']]);
    }

    public function test_delete_category_successfully()
    {
        $category = Category::factory()->create();

        $this->delete(self::ENDPOINT.'/'.$category->category_id);

        $this->assertDatabaseMissing('categories', ['category_id'=>$category->category_id]);
    }

    public function test_view_create_category_success(): void
    {
        $this->withoutExceptionHandling();

        $this->get(self::ENDPOINT.'/create')->assertOk();
    }

    public function test_view_edit_category_success(): void
    {
        $category = Category::factory()->create();

        $this->get(self::ENDPOINT.'/edit/'.$category->category_id)->assertOk()->assertSee($category->name);
    }
}
