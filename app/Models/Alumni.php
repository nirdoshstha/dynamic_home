<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends BackendBaseModel
{
    protected $table = 'alumnies';
    protected $fillable = [
        'type',
        'title',
        'sub_title',
        'designation',
        'company',
        'academy_year',
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
