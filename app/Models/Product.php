<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'hpp',
        'margin',
        'price',
        'deleted_by',
    ];

    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
