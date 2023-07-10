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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('ci')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('age');
            $table->string('genere');
            $table->string('phone')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('zip_code');
            /**
             * Si el paciente es menor de edad
             */
            $table->string('is_minor')->default('false');
            $table->string('re_name')->nullable();
            $table->string('re_last_name')->nullable();
            $table->string('re_ci')->nullable();
            $table->string('re_email')->nullable();
            $table->string('re_phone')->nullable();
            $table->string('user_id');
            $table->string('center_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
