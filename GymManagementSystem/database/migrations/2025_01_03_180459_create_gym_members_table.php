<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gym_members', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('membership_type')->nullable();
            $table->date('membership_start_date')->nullable();
            $table->date('membership_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
