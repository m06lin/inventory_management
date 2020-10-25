<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'elements';

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'element_product', 'element_id', 'product_id');
    }
}
