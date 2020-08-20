<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public function pais()
    {
        return $this->belongsTo("App\Pais");
    }

    public function municipios()
    {
        return $this->hasMany("App\Municipio");
    }
}
