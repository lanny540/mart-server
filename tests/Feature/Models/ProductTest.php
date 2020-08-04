<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 产品总览
     */
    public function product_index_api_should_return_paginate_data()
    {
        factory(Category::class, 5)->create();
        factory(Product::class, 50)->create();

        $response = $this->json('GET', 'api/products');

        $response->assertStatus(200);

        // 检查结果当前页是1
        $response->assertJsonFragment([
            'current_page' => 1
        ]);

        // 结果是否包含 meta、links 标签
        $response->assertJsonStructure([
            'meta',
            'links',
        ]);

        // 判断每页数据是10条
        $data = json_decode($response->getContent())->data;

        self::assertCount(10, $data);
    }

    //TODO: 产品总览筛选、过滤

    /**
     * @test 产品详情
     */
    public function product_show_api_should_return_a_exist_product()
    {
        // 产品不存在
        $response = $this->json('GET', 'api/products/heelo');

        $response->assertStatus(404);

        // 产品存在
        factory(Category::class, 1)->create();
        $product = factory(Product::class, 1)->create()->first();

        $response = $this->json('GET', 'api/products/' . $product->slug);

        $response->assertJsonFragment([
            'slug' => $product->slug,
        ]);
    }
}
