<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('fund_required')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('user_id')->constrained('users');
            $table->string('customerName');
            $table->string('customerOrder');
            $table->text('description'); // Changed to 'text' type to allow multiple paragraphs
            $table->string('status');
            $table->string('company_registration_number')->nullable();
            $table->string('order_photo')->nullable();
            $table->string('additional_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fundings');
    }
}
