<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_corporation', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('name_bn', 250)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('lat', 100)->nullable();
            $table->string('lon', 100)->nullable();
            $table->longText('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_corporation');
    }
};
