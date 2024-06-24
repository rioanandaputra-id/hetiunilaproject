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
        'timeline_week',
        'timeline_day',
        'timeline_start',
        'timeline_end',
        'is_active',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function cvw()
    {
        return $this->hasMany(Cvw::class);
    }
}
