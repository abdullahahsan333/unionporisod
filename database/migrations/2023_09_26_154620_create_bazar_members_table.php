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
        Schema::create('bazar_members', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('created')->nullable();
            $table->string('holder_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('business_name')->nullable();
            $table->integer('district_id')->nullable()->index('district_id');
            $table->integer('upazila_id')->nullable()->index('upazila_id');
            $table->integer('union_id')->nullable()->index('union_id');
            $table->integer('ward_id')->nullable()->index('ward_id');
            $table->string('ward_name')->nullable();
            $table->string('holding_no')->nullable();
            $table->string('tenant')->nullable();
            $table->string('tenant_name')->nullable();
            $table->string('tenant_father_name')->nullable();
            $table->decimal('tenant_business_assets', 11)->nullable();
            $table->string('holder_name_en')->nullable();
            $table->string('father_name_en')->nullable();
            $table->string('mother_name_en')->nullable();
            $table->string('business_name_en')->nullable();
            $table->string('license_no')->nullable();
            $table->string('bazar_license')->nullable();
            $table->string('tenant_en')->nullable();
            $table->string('tenant_name_en')->nullable();
            $table->string('tenant_fathe_name_en')->nullable();
            $table->string('bazar_name_en')->nullable();
            $table->integer('pre_district_id')->nullable();
            $table->integer('pre_upazila_id')->nullable();
            $table->integer('pre_union_id')->nullable();
            $table->integer('pre_ward_id')->nullable();
            $table->string('pre_holding_no')->nullable();
            $table->string('pre_road_no')->nullable();
            $table->string('pre_village')->nullable();
            $table->string('pre_village_en')->nullable();
            $table->string('pre_post_office')->nullable();
            $table->string('pre_post_office_en')->nullable();
            $table->string('pre_post_code')->nullable();
            $table->integer('par_district_id')->nullable();
            $table->integer('par_upazila_id')->nullable();
            $table->integer('par_union_id')->nullable();
            $table->integer('par_ward_id')->nullable();
            $table->string('par_holding_no')->nullable();
            $table->string('par_road_no')->nullable();
            $table->string('par_village')->nullable();
            $table->string('par_village_en')->nullable();
            $table->string('par_post_office')->nullable();
            $table->string('par_post_office_en')->nullable();
            $table->string('par_post_code')->nullable();
            $table->decimal('total_land', 11)->nullable();
            $table->string('bazar_name')->nullable();
            $table->decimal('total_assets', 11)->nullable();
            $table->decimal('business_income', 11)->nullable();
            $table->decimal('annual_assessment', 11)->nullable();
            $table->decimal('total_taxes', 11)->nullable();
            $table->mediumText('path')->nullable();
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
        Schema::dropIfExists('bazar_members');
    }
};
