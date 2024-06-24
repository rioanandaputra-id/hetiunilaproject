<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PmscGallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pmsc_galleries';

    protected $fillable = [
        'pmsc_id',
        'gallery_image',
        'gallery_desc',
    ];

    public function pmsc()
    {
        return $this->belongsTo(Pmsc::class);
    }
}

