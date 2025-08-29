<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatchers', function (Blueprint $table) {
            $table->decimal('walletBalance', 10, 2)->default(0.00);
        });
    }
    
    public function down()
    {
        Schema::table('dispatchers', function (Blueprint $table) {
            $table->dropColumn('walletBalance');
        });
    }

}