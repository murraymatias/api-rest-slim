<?php

declare(strict_types=1);

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{    
    public $table = "usuarios";
    public $timestamps = false;
    //protected $primaryKey = "id";
}