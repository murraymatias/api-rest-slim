<?php

namespace App\Models;

class Usuario extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;

    public function mascotas()
    {
        return $this->hasMany('App\Models\Mascota');
    }
}