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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description', 5000);
            $table->double('required_capital')->nullable();
            $table->double('current_capital')->nullable();
            $table->string('progress_status');
            $table->string('project_photo')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('companies');
            $table->double('profit_margin_bersama');
            $table->double('profit_margin_investor');
            $table->double('profit')->nullable();
            $table->foreignId('funding_id')->nullable()->constrained('fundings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
