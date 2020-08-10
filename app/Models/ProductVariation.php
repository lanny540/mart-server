<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'specification' => 'object'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
