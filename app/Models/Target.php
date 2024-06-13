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

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
