<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function taxrate()
    {
        return $this->belongsTo(Taxrate::class)->select('id','tax_rate');
    }
}
