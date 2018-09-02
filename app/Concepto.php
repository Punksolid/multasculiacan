<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{

    public function multa()
    {
        return $this->belongsTo(Multa::class,"multa_id");
    }
}
