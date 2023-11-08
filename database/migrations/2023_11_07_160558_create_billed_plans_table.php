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
            $table->integer('user_id')->nullabel();
            $table->integer('laboratory_id')->nullabel();
            
            /**
             * Formularios de pago
             * -------------------
             */
            $table->string('type_plan')->nullabel();
            $table->string('methodo_payment')->nullabel();
            $table->string('name')->nullabel();
            $table->string('last_name')->nullabel();
            $table->string('number_id')->nullabel();
            $table->string('email')->nullabel();
            $table->string('number_card')->nullabel();
            $table->string('code_card')->nullabel();
            $table->string('amount')->nullabel();
            $table->string('date')->nullabel();
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
