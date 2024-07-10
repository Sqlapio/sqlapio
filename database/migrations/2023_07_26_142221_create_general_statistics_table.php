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
        Schema::create('general_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('patient')->nullable();
            $table->integer('is_minor')->nullable();
            $table->string('patient_genere')->nullable();
            $table->integer('dairy_sin_confirmar')->nullable();
            $table->integer('dairy_confirmar')->nullable();
            $table->integer('dairy_finalizada')->nullable();
            $table->integer('dairy_cancelada')->nullable();
            $table->integer('center')->nullable();
            $table->string('date')->nullable();
            $table->string('state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_statistics');
    }
};
