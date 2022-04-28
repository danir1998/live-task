<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Category extends Model
{
    use HasFactory, DatabaseMigrations;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
