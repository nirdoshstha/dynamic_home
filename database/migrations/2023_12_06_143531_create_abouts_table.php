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
        Schema::create('abouts', function (Blueprint $table) {
            // $table->id();
            // $table->string('type')->nullable();
            // $table->foreignId('category_id')->nullable()->constrained('categories');
            // $table->string('name')->nullable();
            // $table->string('designation')->nullable();
            // $table->integer('rank')->nullable();
            // $table->string('image')->nullable();
            // $table->longText('description')->nullable();
            // $table->string('seo_title')->nullable();
            // $table->string('seo_keyword')->nullable();
            // $table->mediumText('seo_description')->nullable();
            // $table->boolean('status')->default(0);
            // $table->foreignId('created_by')->constrained('users');
            // $table->foreignId('updated_by')->nullable()->constrained('users');
            // $table->timestamps();

            $table->id();
            $table->string('type')->nullable();

            // Foreign key to categories
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->integer('rank')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->mediumText('seo_description')->nullable();
            $table->boolean('status')->default(0);

            // Foreign keys to users
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
