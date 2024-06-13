<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'meeting_id',
        'gallery_image',
        'gallery_desc',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}

