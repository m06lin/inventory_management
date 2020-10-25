<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function elements()
    {
        return $this->hasMany(Element::class, 'gourp_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'gourp_id');
    }
}
