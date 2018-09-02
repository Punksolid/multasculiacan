<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MultaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id" => null,
            "folio" => $this->folio,
            "importe" => str_replace("$ ", "", $this->importe),
            "redondeo" => $this->redondeo
        ];
    }
}
