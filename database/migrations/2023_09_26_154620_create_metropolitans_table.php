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
        Schema::create('metropolitans', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('division_id')->nullable();
            $table->string('name', 25);
            $table->string('bn_name', 25);
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
        Schema::dropIfExists('metropolitans');
    }
};
