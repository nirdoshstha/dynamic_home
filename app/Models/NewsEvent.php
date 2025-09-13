<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEvent extends BackendBaseModel
{
    use HasFactory;
    protected $table = 'news_events';
    protected $fillable = [
        'type',
        'title',
        'sub_title',
        'image',
        'description',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'status',
        'created_by',
        'updated_by'
    ];
}
