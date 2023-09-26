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
        Schema::create('trade_licenses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('created')->nullable();
            $table->integer('district_id')->nullable()->index('district_id');
            $table->integer('upazila_id')->nullable()->index('upazila_id');
            $table->integer('union_id')->nullable()->index('union_id');
            $table->string('license_no')->nullable();
            $table->string('finance_year')->nullable();
            $table->string('license_owner')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nid')->nullable();
            $table->text('address')->nullable();
            $table->string('business_name')->nullable();
            $table->text('business_address')->nullable();
            $table->string('business_type')->nullable();
            $table->decimal('license_fee', 15)->nullable()->default(0);
            $table->string('spouse_name')->nullable();
            $table->string('business_nature')->nullable();
            $table->string('zone')->nullable();
            $table->string('business_name_en')->nullable();
            $table->string('license_owner_en')->nullable();
            $table->string('father_name_en')->nullable();
            $table->string('mother_name_en')->nullable();
            $table->string('spouse_name_en')->nullable();
            $table->string('business_nature_en')->nullable();
            $table->string('business_type_en')->nullable();
            $table->string('business_address_en')->nullable();
            $table->date('business_start')->nullable();
            $table->string('zone_en')->nullable();
            $table->integer('pre_district_id')->nullable()->index('pre_district_id');
            $table->integer('pre_upazila_id')->nullable()->index('pre_upazila_id');
            $table->integer('pre_union_id')->nullable()->index('pre_union_id');
            $table->integer('pre_ward_id')->nullable()->index('pre_ward_id');
            $table->string('pre_holding_no')->nullable();
            $table->string('pre_road_no')->nullable();
            $table->string('pre_village')->nullable();
            $table->string('pre_post_office')->nullable();
            $table->string('pre_post_code')->nullable();
            $table->integer('par_district_id')->nullable()->index('par_district_id');
            $table->integer('par_upazila_id')->nullable()->index('par_upazila_id');
            $table->integer('par_union_id')->nullable()->index('par_union_id');
            $table->integer('par_ward_id')->nullable()->index('par_ward_id');
            $table->string('par_holding_no')->nullable();
            $table->string('par_road_no')->nullable();
            $table->string('par_village')->nullable();
            $table->string('par_post_office')->nullable();
            $table->string('par_post_code')->nullable();
            $table->string('pre_village_en')->nullable();
            $table->string('pre_post_office_en')->nullable();
            $table->string('par_village_en')->nullable();
            $table->string('par_post_office_en')->nullable();
            $table->string('tenant')->nullable();
            $table->string('tenant_en')->nullable();
            $table->string('tenant_name')->nullable();
            $table->string('tenant_name_en')->nullable();
            $table->string('tenant_father_name')->nullable();
            $table->string('tenant_father_name_en')->nullable();
            $table->string('tenant_business_assets')->nullable();
            $table->string('total_assets')->nullable();
            $table->string('business_income')->nullable();
            $table->string('total_land')->nullable();
            $table->string('bazar_name')->nullable();
            $table->string('annual_asswssment')->nullable();
            $table->string('total_taxes')->nullable();
            $table->string('tin')->nullable();
            $table->string('bin')->nullable();
            $table->string('email')->nullable();
            $table->string('tax_serial_no')->nullable();
            $table->string('due_year')->nullable();
            $table->decimal('due_charge', 15)->nullable()->default(0);
            $table->decimal('sur_charge', 15)->nullable()->default(0);
            $table->decimal('amendment_charge', 15)->nullable()->default(0);
            $table->decimal('signboard_charge', 15)->nullable()->default(0);
            $table->decimal('income_tax', 15)->nullable()->default(0);
            $table->decimal('vat', 15)->nullable()->default(0);
            $table->decimal('tax_2', 15)->nullable()->default(0);
            $table->decimal('service_charge', 15)->default(0);
            $table->decimal('total', 15)->nullable()->default(0);
            $table->text('path')->nullable();
            $table->date('validity_period')->nullable();
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
        Schema::dropIfExists('trade_licenses');
    }
};
