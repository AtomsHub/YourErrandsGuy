<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatcher extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'home_address',
        'date_of_birth',
        'national_id_number',
        'driver_license_number',
        'id_document_path',
        'motorbike_license_plate_number',
        'bank_account_name',
        'bank_account_number',
        'bank_name',
        'status',
        'hackney_permit',
        'license_expiration_date'
    ];
}
