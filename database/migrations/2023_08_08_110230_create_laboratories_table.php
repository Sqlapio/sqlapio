<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('code_lab')->unique()->nullable(); //SQ-LAB-12345678
            $table->string('user_id')->nullable();
            $table->string('business_name');
            $table->string('email')->unique();
            $table->string('rif')->unique()->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('license')->nullable();
            $table->string('type_laboratory')->nullable();
            $table->string('responsible')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('website')->nullable();
            $table->string('lab_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
