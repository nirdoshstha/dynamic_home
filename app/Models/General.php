<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends BackendBaseModel
{
    use HasFactory;
    protected $table ='generals';
    protected $fillable =[
        'type',
        'user_id',
        'profile_id',
        'name',
        'link',
        'icon',
        'rank',
        'status',
        'created_by',
        'updated_by'
    ];


}
