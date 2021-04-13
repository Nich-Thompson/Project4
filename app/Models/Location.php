<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'city',
        'street',
        'number',
        'postal_code',
        'building_number',
        'customer_id'
    ];
}
