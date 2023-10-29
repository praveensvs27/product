<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddunitPriceDiscountTaxProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('unit_id');
			$table->decimal('price', 10, 2);
			$table->integer('discount_percentage');
			$table->decimal('discount_amount', 10, 2);
			$table->date('discount_range_date')->nullable();
			$table->decimal('tax_percentage', 10, 2);
			$table->decimal('tax_amount', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
