<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends BackendBaseModel
{
    use HasFactory;
    protected $table ='sliders';
    protected $fillable =[
        'title',
        'image',
        'description',
        'rank',
        'status',
        'created_by',
        'updated_by'
    ];
}
