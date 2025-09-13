<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table ='profiles';
    protected $fillable =[
        'user_id',
        'image',
        'phone',
        'description',
        'company',
        'designation',
        'address',
    ];

    public function generals(){
        return $this->hasMany(General::class,'profile_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
