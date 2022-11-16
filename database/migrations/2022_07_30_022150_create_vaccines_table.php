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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaccine_category_id');
            $table->foreign('vaccine_category_id')->references('id')->on('vaccine_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('vaccine_name');
            $table->bigInteger('doses');
            $table->string('second_dose_years_interval');
            $table->string('second_dose_months_interval');
            $table->string('second_dose_days_interval');
            $table->string('third_dose_years_interval');
            $table->string('third_dose_months_interval');
            $table->string('third_dose_days_interval');
            $table->string('status');
            $table->string('description');
            $table->date('date_created');
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
        Schema::dropIfExists('vaccines');
    }
};
