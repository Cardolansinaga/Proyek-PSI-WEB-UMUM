<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('teachers');
    }

    public function down(): void
    {
        if (Schema::hasTable('teachers')) {
            return;
        }

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
    }
};
