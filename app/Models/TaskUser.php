<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class TaskUser extends Model
{
    use HasFactory;

    protected $appends = ['done'];
    protected $hidden = ['is_done'];
    protected $fillable = ['user_id', 'task_id'];


    public function getDoneAttribute()
    {
        return (bool)$this->is_done;
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
