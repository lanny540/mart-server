<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 一个分类是否拥有多个子分类
     */
    public function a_category_has_many_children(): void
    {
        $parent = factory(Category::class)->create();

        $parent->children()->saveMany([
            factory(Category::class)->create(),
            factory(Category::class)->create(),
            factory(Category::class)->create(),
        ]);

        self::assertCount(3, $parent->children);
    }

    /**
     * @test 一个子分类是否只拥有一个父分类
     */
    public function a_category_has_only_one_parent(): void
    {
        $child = factory(Category::class)->create();
        $parent = factory(Category::class)->create();

        $parent->children()->save($child);

        self::assertEquals(1, $child->parent()->count());
    }

    /**
     * @test 只获取根分类
     */
    public function a_category_get_roots(): void
    {
        $root = factory(Category::class)->create();
        factory(Category::class)->create();
        Category::create([
            'name' => 'test_name',
            'slug' => 'test_slug',
            'parent_id' => $root->id,
        ]);

        $roots = Category::roots()->get();
        $categories = Category::all();

        self::assertCount(2, $roots);
        self::assertCount(3, $categories);
    }
}
