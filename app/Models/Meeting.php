<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'meeting_date',
        'meeting_location',
        'meeting_agenda',
        'meeting_agenda_en',
        'meeting_week',
    ];


    public function meetingGallery()
    {
        return $this->hasMany(MeetingGallery::class);
    }
}
