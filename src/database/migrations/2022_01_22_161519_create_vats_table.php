<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vats', function (Blueprint $table) {
            $table->id();
            $table->string('country_id', 3);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
            $table->float('rate', 4, 3, true);
            $table->string('type', 16)->default(\App\Models\Vat::TYPE_STD)->comment('vat type: std, reduced');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vats');
    }
}
