<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CvwGallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cvw_galleries';

    protected $fillable = [
        'cvw_id',
        'gallery_image',
        'gallery_desc',
    ];

    public function cvw()
    {
        return $this->belongsTo(Cvw::class);
    }
}
