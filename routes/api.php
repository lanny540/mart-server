<?php

Route::apiResource('categories', 'CategoryController');
Route::apiResource('products', 'ProductController');

Route::get('/', function () {
    $product = \App\Models\Product::find(6);

//    $product->update([
//        'specification' => [
//            'color' => [
//                'name' => '颜色',
//                'options' => ['红色', '绿色', '蓝色'],
//            ],
//            'memory' => [
//                'name' => '内存',
//                'options' => ['8GB & 128GB', '8GB & 256GB', '16GB & 256GB'],
//            ],
//        ]
//    ]);

    $product->variations()->saveMany([
        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '红色',
                'memory' => '8GB & 128GB'
            ],
            'stock' => 1000,
            'price' => 200000,
        ]),
        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '红色',
                'memory' => '16GB & 256GB'
            ],
            'stock' => 800,
            'price' => 300000,
        ]),
        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '蓝色',
                'memory' => '8GB & 128GB'
            ],
            'stock' => 500,
            'price' => 150000,
        ]),
        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '蓝色',
                'memory' => '8GB & 256GB'
            ],
            'stock' => 700,
            'price' => 220000,
        ]),
        \App\Models\ProductVariation::create([
            'specification' => [
                'color' => '蓝色',
                'memory' => '16GB & 256GB'
            ],
            'stock' => 900,
            'price' => 320000,
        ]),
    ]);

    dd($product);
});
