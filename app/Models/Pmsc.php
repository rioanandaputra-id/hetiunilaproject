<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pmsc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pmscs';

    protected $fillable = [
        'project_id',
        'timeline_id',
        'pmsc_date',
        'pmsc_location',
        'pmsc_agenda',
        'pmsc_agenda_en',
        'pmsc_week',
    ];


    public function pmscGallery()
    {
        return $this->hasMany(PmscGallery::class);
    }
}
