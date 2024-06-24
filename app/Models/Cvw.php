<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cvw extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cvws';
    protected $fillable = [
        'project_id',
        'timeline_id',
        'location_id',
        'cvw_plan',
        'cvw_plan_cumulative',
        'cvw_real',
        'cvw_real_cumulative',
        'cvw_deviasi',
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

    public function cvwGallery()
    {
        return $this->hasMany(CvwGallery::class);
    }
}
