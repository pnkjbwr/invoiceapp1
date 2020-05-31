<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxrate extends Model
{
    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
