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
        Schema::create('physical_exams', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('center_id')->nullable();
            $table->string('date');
            $table->string('weight');
            $table->string('height');
            $table->string('strain');
            $table->string('temperature');
            $table->string('breaths');
            $table->string('pulse');
            $table->string('saturation');
            $table->string('condition');

            //signos vitales
            $table->text('hidratado')->nullable();
            $table->text('eupenico')->nullable();
            $table->text('febril')->nullable();
            $table->text('esfera_neurologica')->nullable();
            $table->text('glasgow')->nullable();
            $table->text('esfera_orl')->nullable();
            $table->text('esfera_cardiopulmonar')->nullable();
            $table->text('esfera_abdominal')->nullable();
            $table->text('extremidades')->nullable();
            $table->string('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_exams');
    }
};
