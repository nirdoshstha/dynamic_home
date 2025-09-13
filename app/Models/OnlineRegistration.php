<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Ramsey\Uuid\v1;

class OnlineRegistration extends BackendBaseModel
{
    use HasFactory;
    protected $table ='online_registrations';
    protected $fillable =[
        'image',
        'name',
        'grade',
        'current_grade',
        'gender',
        'nationality',
        'email',
        'dob_bs',
        'dob_ad',
        'age',
        'address',
        'phone',
        'father_name',
        'father_mobile',
        'father_email',
        'father_occupation',
        'mother_name',
        'mother_mobile',
        'mother_email',
        'mother_occupation',
        'guardian',
        'guardian_mobile',
        'guardian_email',
        'guardian_occupation',
        'previous_school_name',
        'previous_school_address',
        'previous_school_grade',
        'description'
    ];
}
