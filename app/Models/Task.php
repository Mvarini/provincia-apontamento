<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Task extends Model
    {
        protected $table = 'tasks';
        protected $fillable = [
            'employee_id',
            'machine_id',
            'product_id',
            'date',
            'production_minute',
            'piece_second',
            'amount_carried',
            'expected_quantity',
            'productivity',
            'discard_quantity',
            'batch_number',
            'missing_quantity',
            'script_time',
            'real_time'
        ];

        public function employee(): belongsTo
        {
            return $this->belongsTo(Employee::class);
        }

        public function machine(): belongsTo
        {
            return $this->belongsTo(Machine::class);
        }

        public function product(): belongsTo
        {
            return $this->belongsTo(Product::class);
        }

        public function taskBreakdowns(): hasMany
        {
            return $this->hasMany(TaskBreakdown::class);
        }
    }
