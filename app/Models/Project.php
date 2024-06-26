<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'projects';
    protected $fillable = [
        'project_logo',
        'project_name',
        'project_start',
        'project_end',
        'project_day',
        'project_week',
    ];

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }
}
