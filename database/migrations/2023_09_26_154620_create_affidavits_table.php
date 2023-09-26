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
        Schema::create('affidavits', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('created')->nullable();
            $table->integer('member_id')->nullable();
            $table->string('affidavit_no')->nullable();
            $table->string('member_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('post_office')->nullable();
            $table->string('village')->nullable();
            $table->string('post_code')->nullable();
            $table->string('member_name_en')->nullable();
            $table->string('father_name_en')->nullable();
            $table->string('mother_name_en')->nullable();
            $table->string('post_office_en')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status_en')->nullable();
            $table->string('religion_en')->nullable();
            $table->string('village_en')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->integer('pourashava_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->string('holding_no')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nid')->nullable();
            $table->integer('inherit_id')->nullable();
            $table->longText('all_data')->nullable();
            $table->date('dob')->nullable();
            $table->date('wife_dob')->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('wife_name')->nullable();
            $table->string('wife_father_name')->nullable();
            $table->string('wife_mother_name')->nullable();
            $table->string('wife_nid_no')->nullable();
            $table->integer('wife_district_id')->nullable();
            $table->integer('wife_upazila_id')->nullable();
            $table->integer('wife_union_id')->nullable();
            $table->integer('wife_ward_id')->nullable();
            $table->string('wife_holding_no')->nullable();
            $table->string('wife_post_office')->nullable();
            $table->string('wife_village')->nullable();
            $table->string('wife_name_en')->nullable();
            $table->string('wife_father_name_en')->nullable();
            $table->string('wife_mother_name_en')->nullable();
            $table->string('wife_post_office_en')->nullable();
            $table->string('wife_village_en')->nullable();
            $table->date('ragi_date')->nullable();
            $table->string('ragi_serial_no')->nullable();
            $table->string('ragi_page_no')->nullable();
            $table->string('ragi_column_no')->nullable();
            $table->string('ragi_year')->nullable();
            $table->string('regi_address')->nullable();
            $table->string('regi_address_en')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('father_profession_en')->nullable();
            $table->decimal('monthly_income', 15)->default(0);
            $table->decimal('yearly_income', 15)->default(0);
            $table->string('affidavit_type')->nullable();
            $table->longText('path')->nullable();
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
        Schema::dropIfExists('affidavits');
    }
};
