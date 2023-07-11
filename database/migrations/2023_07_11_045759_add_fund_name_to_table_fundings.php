<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFundNameToTableFundings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->string('fundName')->nullable()->after('additional_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fundings', function (Blueprint $table) {
            $table->dropColumn('fundName');
        });
    }
}
