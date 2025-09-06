<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'lead_id', 'sales_id', 'description', 'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'project_product')
                    ->withPivot('harga_jual', 'harga_nego')
                    ->withTimestamps();
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }
}

