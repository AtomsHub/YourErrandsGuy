<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->decimal('walletBalance', 10, 2)->default(0.00)->after('password');
        });

        // Auto-generate username & password for existing vendors
        $vendors = DB::table('vendors')->get();

        foreach ($vendors as $vendor) {
            DB::table('vendors')
                ->where('id', $vendor->id)
                ->update([
                    'username' => 'vendor_' . $vendor->id, // unique username
                    'password' => Hash::make('password123'), // default hashed password
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn(['username', 'password', 'walletBalance']);
        });
    }
};
