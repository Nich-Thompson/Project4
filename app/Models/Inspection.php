<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'customer_id',
        'location_id',
        "json",
        "locked",
    ];

    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }
}
