<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'slogan',
        'primary_color',
        'secondary_color',
        'navbar_color',
        'title_color',
        'school_name',
        'address',
        'email',
        'phone',
        'mobile',
        'logo',
        'fav_icon',
        'viber',
        'whatsapp',
        'google_map',
        'show_hide_google_map',
        'gallery_design',
        'scrolling_news',
        'notice_board',
        'management_team',
        'about_design',
        'logo_design',
        'is_counter',
        'counter_code',
        'testimonial_design',
        'brochure_image',
        'brochure',
        'background_image',
        'school_image',
        'college_image',
        'popup_image',
        'master_logo',
        'school_title',
        'college_title',
        'created_by',
        'updated_by'
    ];
}
