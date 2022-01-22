<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypeToVatTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_type_to_vat_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('country_id', 3);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('product_type_id');
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->unsignedBigInteger('vat_id');
            $table->foreign('vat_id')->references('id')->on('vats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_type_to_vat_types');
    }
}
