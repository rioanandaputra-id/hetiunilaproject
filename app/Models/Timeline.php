<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'timelines';
    protected $fillable = [
        'project_id',
        'time_week',
        'time_day',
        'time_start',
        'time_end',
    ];
}
