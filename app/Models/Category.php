<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BackendBaseModel
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable =[
        'title',
        'slug',
        'rank',
        'design',
        'image',
        'description',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'status',
        'created_by',
        'updated_by'
    ];

    public function posts(){
        return $this->hasMany(About::class,'category_id','id')->active();
    }

}
