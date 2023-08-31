<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'project_id',
        'name',
        'status',
        'owner_id'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
