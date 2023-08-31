<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'project_id',
        'task',
        'exp_time',
        'status',
        'price'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function Task(): BelongsTo
    {
        return $this->belongsTo(Task::class,'task','id');
    }
}
