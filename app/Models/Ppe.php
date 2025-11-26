<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Ppe extends Model
    {
        protected $table = 'ppes';
        protected $fillable = ['name', 'ca'];

        public function ppeMovements(): hasMany
        {
            return $this->hasMany(PpeMovement::class);
        }
    }
