<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class ListModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sublist_of'
    ];

    public function values(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(ListValue::class);
    }
}
