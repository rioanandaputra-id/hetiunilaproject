<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'targets';
    protected $fillable = [
        'project_id',
        'location_id',
        'timeline_id',
        'plan_kumulatif',
        'real_kumulatif',
    ];
}
