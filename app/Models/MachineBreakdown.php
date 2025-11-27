<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class MachineBreakdown extends Model
    {
        protected $table = 'machine_breakdowns';
        protected $fillable = ['name'];

    }
