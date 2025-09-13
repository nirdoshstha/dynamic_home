<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends BackendBaseModel
{
    use HasFactory;
    protected $table ='abouts';
    protected $fillable =[
        'type',
        'category_id',
        'name',
        'designation',
        'rank',
        'image',
        'description',
        'seo_title',
        'seo_keyword',
        'seo_description',
        'status',
        'created_by',
        'updated_by'
    ];

    // public function posts(){
    //     return $this->hasMany(About::class,'parent_id','id');
    // }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
