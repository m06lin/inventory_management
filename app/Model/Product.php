<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function elements()
    {
        return $this->belongsToMany(Element::class, 'element_product', 'product_id', 'element_id');
    }
}
