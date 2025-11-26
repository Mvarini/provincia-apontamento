<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class PpeMovement extends Model
    {
        protected $table = 'ppe_movements';
        protected $fillable = ['employee_id', 'ppe_id', 'quantity', 'size', 'date'];

        public function employee(): BelongsTo
        {
            return $this->belongsTo(Employee::class);
        }

        public function ppe(): BelongsTo
        {
            return $this->belongsTo(Ppe::class);
        }
    }
