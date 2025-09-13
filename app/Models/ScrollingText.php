<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrollingText extends BackendBaseModel
{
    use HasFactory;
    protected $table = 'scrolling_texts';
    protected $fillable = [
        'description',
        'status',
        'created_by',
        'updated_by'
    ];
}
