<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function pedidos()
    {
        return $this->belongsToMany("App\Pedido", "pedido_productos");
    }
}
