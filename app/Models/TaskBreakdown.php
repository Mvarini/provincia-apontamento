<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class TaskBreakdown extends Model
    {
        protected $table = 'task_breakdowns';
        protected $fillable = ['task_id', 'machine_breakdown_id', 'duration'];

        public function task(): belongsTo
        {
            return $this->belongsTo(Task::class);
        }

        public function machineBreakdown(): belongsTo
        {
            return $this->belongsTo(MachineBreakdown::class);
        }
    }
