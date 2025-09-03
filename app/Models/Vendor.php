<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'address',
        'description',
        'service_type',
        'image',
        'tag',
        'walletBalance',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function vitems()
    {
        return $this->hasMany(VendorItem::class);
    }

    public function deliveryfee()
    {
        return $this->hasMany(DeliveryFee::class);
    }

    public function vendorItems()
    {
        return $this->hasMany(VendorItem::class, 'vendor_id');
    }

    public function item()
    {
        return $this->hasOneThrough(
            Items::class,
            VendorItem::class,
            'vendor_id',   // Foreign key on vendor_items table
            'id',          // Foreign key on items table
            'id',          // Local key on vendors table
            'items_id'     // Local key on vendor_items table
        );
    }

}
