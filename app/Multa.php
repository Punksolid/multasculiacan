<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
        protected $fillable = [
          'folio',
          'placa',
          'importe',
          'redondeo',
          'multas_html',
          'html',
        ];

        public function conceptos()
        {
            return $this->hasMany(Concepto::class,"multa_id");
        }
}
