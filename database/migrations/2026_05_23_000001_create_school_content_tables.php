<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Berita');
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('image_class')->nullable();
            $table->string('status')->default('published');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name')->nullable();
            $table->string('class_name')->nullable();
            $table->string('competition')->nullable();
            $table->string('level')->default('Nasional');
            $table->string('rank')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->text('description')->nullable();
            $table->string('image_class')->nullable();
            $table->string('status')->default('published');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('Organisasi Siswa');
            $table->string('coordinator')->nullable();
            $table->string('mentor')->nullable();
            $table->string('schedule')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Aktif');
            $table->boolean('is_published')->default(true);
            $table->string('image_class')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('subject')->nullable();
            $table->string('type')->default('teacher');
            $table->string('category')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->string('image_class')->nullable();
            $table->string('status')->default('active');
            $table->boolean('is_leadership')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_class')->default('library');
            $table->string('status')->default('published');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('ppdb_applications', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('full_name');
            $table->string('pathway')->default('Zonasi');
            $table->string('origin_school')->nullable();
            $table->string('phone')->nullable();
            $table->string('parent_name')->nullable();
            $table->text('address')->nullable();
            $table->string('status')->default('waiting');
            $table->json('documents')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_applications');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('site_settings');
    }
};
