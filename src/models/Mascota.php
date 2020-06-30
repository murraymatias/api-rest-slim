<?php

namespace App\Models;

class Mascota extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
}