<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    protected $fillable = ['name', 'price', 'vendor_id'];
}
