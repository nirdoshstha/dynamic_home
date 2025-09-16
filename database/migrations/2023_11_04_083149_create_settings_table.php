<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('slogan')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('navbar_color')->nullable();
            $table->string('title_color')->nullable();

            $table->string('school_name')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('viber')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('google_map')->nullable();
            $table->boolean('show_hide_google_map')->default(0);
            $table->boolean('gallery_design')->default(0);
            $table->boolean('scrolling_news')->default(0);
            $table->boolean('notice_board')->default(0);
            $table->boolean('management_team')->default(0);
            $table->boolean('about_design')->default(0);
            $table->boolean('logo_design')->default(0);
            $table->boolean('is_counter')->default(0);

            $table->string('brochure_image')->nullable();
            $table->string('brochure')->nullable();

            $table->string('background_image')->nullable();
            $table->string('school_image')->nullable();
            $table->string('college_image')->nullable();

            $table->string('popup_image')->nullable();
            $table->string('master_logo')->nullable();

            $table->string('school_title')->nullable();
            $table->string('college_title')->nullable();

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
