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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('total')->nullable();
            $table->double('profit')->nullable();
            $table->string('status');
            $table->string('payment_proof')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
