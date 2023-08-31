<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_user extends Model
{
    use HasFactory;

    protected $table = 'project_users';

    protected $fillable = [
        'user_id',
        'project_id'
    ];
}
