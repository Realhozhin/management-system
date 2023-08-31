<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'category_id',
        'project_name',
        'tasks',
        'description',
        'company',
        'exp_time'
    ];
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function Task()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }
    public function projectProducer()
    {
        return $this->hasMany(projectProducers::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'project_producers','producer_id');
    }
}
