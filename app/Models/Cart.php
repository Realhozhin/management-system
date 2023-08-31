<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'producer_id',
        'project_id',
        'task_id'
    ];
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function Task(): BelongsTo
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }
}
