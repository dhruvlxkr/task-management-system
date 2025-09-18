<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'priority', 'deadline', 'status', 'user_id'
    ];

    public function documents()
    {
        return $this->hasMany(TaskDocument::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
