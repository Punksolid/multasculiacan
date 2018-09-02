<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{

    protected $primaryKey = "folio";

    protected $table = null;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

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
