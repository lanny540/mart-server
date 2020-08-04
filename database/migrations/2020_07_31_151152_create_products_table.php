<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品名称');
            $table->string('slug')->unique();
            $table->string('poster')->nullable()->comment('商品大图');
            $table->text('description')->nullable()->comment('商品描述');
            $table->unsignedInteger('price')->default(100)->comment('商品价格，单位为分，默认一元');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('brand', 128)->nullable()->comment('厂商信息');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
