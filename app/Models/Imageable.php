<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Imageable extends Model
{

    protected $guarded = [];

    public function imageable()
    {
        return $this->morphTo();
    }
}
