<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends BackendBaseModel
{
    use HasFactory;
    protected $table = 'downloads';
    protected $fillable =[
        'title',
        'slug',
        'rank',
        'image',
        'status',
        'created_by',
        'updated_by'
    ];
}
