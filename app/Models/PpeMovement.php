<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class PpeMovement extends Model
    {
        protected $table = 'ppe_movements';
        protected $fillable = ['employee_id', 'ppe_id', 'quantity', 'size', 'date'];
    }
