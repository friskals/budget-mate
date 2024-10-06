<?php

namespace Feature;

use App\Models\Category;
use App\Models\Icon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
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

    public function test_show_detail()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->get(self::ENDPOINT.'/'.$category->category_id, ['id'=>$category->category_id])
            ->assertSee($category->id, $category->name);
    }
}
