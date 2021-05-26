<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_type_id',
        'json'
    ];

    public function inspection_type()
    {
        return $this->HasOne(InspectionType::class)->first();
    }
}
