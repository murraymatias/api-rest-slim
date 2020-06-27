<?php

namespace Config\Migrations;

require_once __DIR__ . '/../../vendor/autoload.php';

use Config\Database;

new Database();

use Illuminate\Database\Capsule\Manager as Capsule;


//Tablas a partir de aca
Capsule::schema()->create('usuarios', function ($table) {

       $table->increments('id');

       $table->string('email')->unique();

       $table->string('password');

       $table->timestamps();

   });