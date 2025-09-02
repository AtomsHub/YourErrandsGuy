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

}
