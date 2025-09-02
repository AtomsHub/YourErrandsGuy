<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'items_id');
    }
    



    protected $fillable = ['name', 'price', 'vendor_id'];
}
