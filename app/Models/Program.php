<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends BackendBaseModel
{
    use HasFactory;
    protected $table = 'programs';
    protected $fillable = [
        'type',
        'title',
        'sub_title',
        'slug',
        'banner',
        'image',
        'description',
        'courses',
        'university',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'status',
        'created_by',
        'updated_by'
    ];

    // public function images()
    // {
    //     return $this->morphMany(Imageable::class, 'imageable');
    // }
}
