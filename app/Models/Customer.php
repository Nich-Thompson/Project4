<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'city',
        'street',
        'number',
        'postal_code',
        'phone_number',
        'contact_name',
        'contact_phone_number',
        'contact_email',
        'deleted_at'
    ];
}
