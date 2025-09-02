<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to Vendor (Restaurant Owner)
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function dispatcher()
    {
        return $this->belongsTo(Dispatcher::class);
    }


    /**
     * Order has many cart items.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'order_id');
    }


    


}
