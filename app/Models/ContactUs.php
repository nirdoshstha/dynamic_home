<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends BackendBaseModel
{
    use HasFactory;
    protected $table = 'contact_us';
    protected $fillable =[
        'type',
        'name',
        'email', 
        'subject',
        'message',

    ];
}
