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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('email');
            $table->string('email_verified_at')->nullable();
            $table->string('password')->nullable();
            /**
             * Roles:
             * @uses medico
             * @uses paciente
             */
            $table->string('role')->nullable();
            $table->string('specialty')->nullable();
            /**
             * Informacion adicional
             */
            $table->string('ci')->unique()->nullable();
            $table->string('birthdate')->nullable();
            $table->string('age')->nullable();
            $table->string('genere')->nullable();
            $table->string('phone')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('user_img')->nullable();
            $table->string('digital_cello')->nullable();
            $table->string('cod_mpps')->nullable();
            /**
             * Campos para contar
             * acciones del usuario de acuerdo
             * al plan asignado
             *
            */
            $table->string('type_plane')->nullable();
            $table->string('token')->nullable();
            $table->integer('patient_counter')->default(0)->nullable();
            $table->integer('medical_record_counter')->default(0)->nullable();
            $table->integer('ref_counter')->default(0)->nullable();
            $table->string('cod_update_email')->nullable();
            $table->string('cod_update_pass')->nullable();
            $table->string('date_start_plan')->nullable();
            $table->string('date_end_plan')->nullable();
            $table->boolean('expired_plan')->nullable()->default(false);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
