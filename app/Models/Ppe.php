<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Ppe extends Model
    {
        protected $table = 'ppes';

        protected $fillable = ['name', 'ca'];
    }
