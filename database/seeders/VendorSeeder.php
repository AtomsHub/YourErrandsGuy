<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\VendorItem;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Vendor::factory(10)->create()->each(function ($vendor) {
            VendorItem::factory(rand(5, 10))->create([
                'vendor_id' => $vendor->id,
            ]);
        });
    }
}
