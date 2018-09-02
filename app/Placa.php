<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{

    protected $primaryKey = "folio";

    protected $table = null;

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    public function multas()
    {
        return Multa::where('placa', $this->primaryKey)->get();
    }
}
