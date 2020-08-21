<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //relacionado con la tabla pais
    public function ciudades()
    {
        return $this->hasMany("App\Ciudad");
    }

}
