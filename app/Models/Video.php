<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends BackendBaseModel
{
    use HasFactory;
    protected $table ='videos';
    protected $fillable =[
        'type',
        'title',
        'image',
        'video_link',
        'description',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'status',
        'created_by',
        'updated_by'
    ];

}
