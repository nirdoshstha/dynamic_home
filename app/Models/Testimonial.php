<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends BackendBaseModel
{
    protected $table ='testimonials';
    protected $fillable =[
        'type',
        'title',
        'sub_title',
        'designation',
        'company',
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
