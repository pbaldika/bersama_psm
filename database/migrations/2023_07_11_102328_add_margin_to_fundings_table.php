<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarginToFundingsTable extends Migration
{
    public function up()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->double('profit_margin_user')->nullable(false);
            $table->double('profit_margin_investor')->nullable(false);
        });
    }

    public function down()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->dropColumn('profit_margin_user');
            $table->dropColumn('profit_margin_investor');
        });
    }
}
