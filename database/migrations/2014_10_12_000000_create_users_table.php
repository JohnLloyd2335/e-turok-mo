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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_type_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('date_of_birth');
            $table->string('age');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status');
            $table->string('profile_img')->nullable();
            $table->date('date_recorded');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
