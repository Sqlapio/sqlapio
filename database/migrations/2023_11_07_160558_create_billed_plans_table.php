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
        Schema::create('billed_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('laboratory_id')->nullable();

            /**
             * Formularios de pago
             * -------------------
             */
            $table->string('type_plan')->nullable();
            $table->string('methodo_payment')->nullable();
            $table->string('number_card')->nullable();
            $table->string('code_card')->nullable();
            $table->string('amount')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->default('first payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billed_plans');
    }
};
