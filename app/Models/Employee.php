<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Employee extends Model
    {
        protected $table = 'employees';

        protected $fillable = ['name', 'job_title', 'department'];


        public function tasks(): hasMany
        {
            return $this->hasMany(Task::class);
        }
    }


