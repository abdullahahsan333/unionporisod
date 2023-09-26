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
        Schema::create('districts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('division_id')->index('division_id');
            $table->string('name', 25);
            $table->string('bn_name', 25);
            $table->string('lat', 15)->nullable();
            $table->string('lon', 15)->nullable();
            $table->string('url', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
};
