<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends BackendBaseModel
{
    use HasFactory;
    protected $table ='messages';
    protected $fillable =[
        'type',
        'title',
        'name',
        'designation',
        'slug',
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
