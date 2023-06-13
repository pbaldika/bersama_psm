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
        Schema::create('fundings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('fund_required')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('customer_id')->constrained('users');
            $table->string('customerName');
            $table->string('customerOrder');
            $table->string('description');
            $table->string('status');
            $table->string('company_registration_number')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundings');
    }
};
