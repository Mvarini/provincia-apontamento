<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Profile extends Model
    {
        protected $table = 'profiles';
        protected $fillable = ['user_id', 'nickname', 'image', 'birthday', 'phone', 'gender'];

        public function user(): belongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
