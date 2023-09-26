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
        Schema::create('members', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('created')->nullable();
            $table->integer('division_id')->nullable()->index('division_id');
            $table->integer('district_id')->nullable()->index('district_id');
            $table->integer('upazila_id')->nullable()->index('upazila_id');
            $table->integer('union_id')->nullable()->index('union_id');
            $table->integer('ward_id')->nullable()->index('ward_id');
            $table->string('holding_no')->nullable();
            $table->string('village')->nullable();
            $table->string('village_en')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('name')->nullable();
            $table->string('householder')->nullable();
            $table->string('householder_en')->nullable();
            $table->string('householder_wife')->nullable();
            $table->string('householder_wife_en')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_name_en')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_name_en')->nullable();
            $table->string('religion')->nullable();
            $table->string('religion_en')->nullable();
            $table->string('profession')->nullable();
            $table->string('profession_en')->nullable();
            $table->string('gender')->nullable();
            $table->string('gender_en')->nullable();
            $table->string('settlement_type')->nullable();
            $table->string('settlement_type_en')->nullable();
            $table->string('ownership_type')->nullable();
            $table->string('ownership_type_en')->nullable();
            $table->string('handicapped')->nullable();
            $table->string('handicapped_en')->nullable();
            $table->string('handicapped_name')->nullable();
            $table->string('handicapped_name_en')->nullable();
            $table->string('social_security_act')->nullable();
            $table->string('social_security_act_en')->nullable();
            $table->string('social_act_name')->nullable();
            $table->string('social_act_name_en')->nullable();
            $table->string('freedom_fighters')->nullable();
            $table->string('freedom_fighters_en')->nullable();
            $table->string('fighter_name')->nullable();
            $table->string('fighter_name_en')->nullable();
            $table->string('fighter_reletion')->nullable();
            $table->string('fighter_relation_en')->nullable();
            $table->string('poverty_line')->nullable();
            $table->string('poverty_line_en')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('member_male')->nullable();
            $table->string('member_female')->nullable();
            $table->string('floor_size')->nullable();
            $table->decimal('cultivable_land', 10)->nullable();
            $table->decimal('uncultivated_land', 10)->nullable();
            $table->string('bazar')->nullable();
            $table->string('business_assets')->nullable();
            $table->string('trade_license_no')->nullable();
            $table->string('tubewell')->nullable();
            $table->string('latrine')->nullable();
            $table->decimal('annual_income', 15)->nullable()->default(0);
            $table->decimal('estimated_value', 15)->nullable()->default(0);
            $table->decimal('annual_assessment', 15)->nullable()->default(0);
            $table->decimal('taxes', 15)->nullable()->default(0);
            $table->text('path')->nullable();
            $table->string('status')->default('active')->index('status');
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
        Schema::dropIfExists('members');
    }
};
