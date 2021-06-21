<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'list_model_id',
        'list_value_id'
    ];

    public function linked_value()
    {
        return ListValue::where('id', $this->list_value_id)->first();
    }

    public function model()
    {
        return ListModel::where('id', $this->list_model_id)->first();
    }
}
