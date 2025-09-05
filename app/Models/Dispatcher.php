<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Dispatcher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    // protected $fillable = [
    //     'full_name',
    //     'phone_number',
    //     'email',
    //     'home_address',
    //     'date_of_birth',
    //     'national_id_number',
    //     'driver_license_number',
    //     'id_document_path',
    //     'motorbike_license_plate_number',
    //     'bank_account_name',
    //     'bank_account_number',
    //     'bank_name',
    //     'status',
    //     'hackney_permit',
    //     'license_expiration_date'
    // ];
    protected $guarded = [];
     public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
}
