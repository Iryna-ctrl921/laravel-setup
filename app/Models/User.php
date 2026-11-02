<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function authoredTasks() {
        return $this->hasMany(Task::class, 'author_id');
    }

    public function assignedTasks() {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function files() {
        return $this->morphMany(File::class, 'fileable');
    }
}
