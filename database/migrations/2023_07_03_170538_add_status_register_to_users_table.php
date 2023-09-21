<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void{
		Schema::table('users', function (Blueprint $table) {
			/**
			 * @param status_register
			 * @value = 1 : registro inicial
			 * @value = 2 : registro completo
			 */
			$table->string('status_register')->default('1');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void{
		Schema::table('users', function (Blueprint $table) {
			//
		});
	}
};
