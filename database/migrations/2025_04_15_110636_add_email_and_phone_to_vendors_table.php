<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailAndPhoneToVendorsTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up(): void
{
    Schema::table('vendors', function (Blueprint $table) {
        $table->string('email')->unique()->nullable(); // or after any existing column
        $table->string('phone')->nullable();

    });
}

public function down(): void
{
    Schema::table('vendors', function (Blueprint $table) {
        $table->dropColumn('email');
        $table->dropColumn('phone');
    });
}

};
