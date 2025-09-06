<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $fillable = ['lead_id', 'name', 'contact', 'address', 'sales_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'customer_product')
                    ->withPivot('harga_nego')
                    ->withTimestamps();
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }
}

