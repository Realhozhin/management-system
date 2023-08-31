<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectProducers extends Model
{
    use HasFactory;

    protected $table = 'project_producers';

    protected $fillable = [
        'project_id',
        'producer_id'
    ];

    public function producers()
    {
        return $this->belongsTo(User::class, 'producer_id', 'id');
    }
}
