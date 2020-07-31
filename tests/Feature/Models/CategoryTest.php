<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 分类index接口返回排序后的根分类
     */
    public function index_api_should_return_sorted_roots_categories()
    {
        $categories = factory(Category::class, 3)->create();
        $categories->each(static function ($category) {
            $category->update([
                'order' => $category->id
            ]);
        });

        $response = $this->json('GET', 'api/categories');

        // 返回结果是否匹配
        $categories->each(static function ($category) use ($response) {
            $response->assertJsonFragment([
                'name' => $category->name,
                'slug' => $category->slug,
            ]);
        });

        // 排序
        $response->assertSeeInOrder([
            $categories->first()->slug, $categories->last()->slug
            /**
             * 倒序
             * $categories->last()->slug, $categories->first()->slug
             */
        ]);
    }
}
