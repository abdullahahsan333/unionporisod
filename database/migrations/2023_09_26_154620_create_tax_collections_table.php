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
        Schema::create('tax_collections', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('created')->nullable();
            $table->integer('member_id')->nullable()->index('member_id');
            $table->string('receipt_no')->nullable();
            $table->integer('annual_assessment');
            $table->string('year', 128)->nullable();
            $table->decimal('taxes', 11)->nullable();
            $table->decimal('paid', 11)->default(0);
            $table->decimal('fine', 11)->nullable()->default(0);
            $table->decimal('total', 11)->nullable()->default(0);
            $table->string('type')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_collections');
    }
};
