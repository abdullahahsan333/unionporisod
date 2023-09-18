<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_messages', function (Blueprint $table) {
            $table->id();
            $table->date('created');
            $table->string('type');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('description');
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('frontend_messages');
    }
}
