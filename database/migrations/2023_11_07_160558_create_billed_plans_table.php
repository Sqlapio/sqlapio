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
            $table->integer('plan_id')->nullabel();
            $table->integer('user_id')->nullabel();
            $table->integer('laboratory_id')->nullabel();
            $table->string('ci')->nullabel();
            $table->string('email')->nullabel();
            $table->decimal('amount',8,2)->nullabel();
            $table->string('reference')->nullabel();
            $table->string('account_number')->nullabel();
            $table->string('bank')->nullabel();
            $table->string('date')->nullabel();
            $table->string('status')->nullabel();
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
