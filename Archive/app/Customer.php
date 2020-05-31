<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function invoices()
    {
        return $this->belongsTo(Invoice::class);
    }
}