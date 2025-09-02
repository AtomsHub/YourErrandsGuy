<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class iCreateDispatchersTable extends Migration
{
    public function up()
    {
        Schema::create('dispatchers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->text('home_address');
            $table->date('date_of_birth');
            $table->string('national_id_number')->unique();
            $table->string('driver_license_number')->unique();
            $table->string('id_document_path'); // for the ID document
            $table->string('motorbike_license_plate_number');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->enum('status', ['approved', 'unapproved', 'disapproved'])->default('unapproved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispatchers');
    }
}
