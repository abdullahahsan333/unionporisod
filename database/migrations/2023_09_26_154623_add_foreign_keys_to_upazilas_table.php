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
        Schema::table('upazilas', function (Blueprint $table) {
            $table->foreign(['district_id'], 'upazilas_ibfk_2')->references(['id'])->on('districts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->dropForeign('upazilas_ibfk_2');
        });
    }
};
