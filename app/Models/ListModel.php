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
        'list_model_id'
    ];

    public function values(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(ListValue::class);
    }

    public function sublistOf(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(ListModel::class);
    }
}
