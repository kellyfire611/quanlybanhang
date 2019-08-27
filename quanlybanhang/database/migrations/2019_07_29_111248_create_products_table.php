<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code', 25);
            $table->string('product_name', 500);
            $table->text('image')->nullable();
            $table->string('description', 250)->nullable();
            $table->decimal('standard_cost', 19, 4);
            $table->decimal('list_price', 19, 4);
            $table->float('quantity_per_unit', 8, 2);
            $table->tinyInteger('discontinued')->nullable();
            $table->float('discount', 8, 2)->nullable();
            
            // Cột khóa ngoại
            $table->integer('category_id')->unsigned();
            $table->integer('supplier_id')->unsigned();

            // Tạo liên kết Khóa ngoại
            $table->foreign('category_id')
                ->references('id')->on('categories');

            $table->foreign('supplier_id')
                ->references('id')->on('suppliers');
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
