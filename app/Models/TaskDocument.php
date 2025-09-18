<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskDocument extends Model
{
    protected $fillable = [
        'task_id', 'file_name', 'original_name'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
