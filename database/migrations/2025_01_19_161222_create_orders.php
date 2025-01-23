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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // User placing the order
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete(); // Only for Restaurant orders 
            $table->string('service_type'); // E.g., "Errand", "Restaurant"
            $table->decimal('item_amount', 10, 2);
            $table->decimal('delivery_fee', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->json('form_details'); // Store receiver/sender details and other info
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
