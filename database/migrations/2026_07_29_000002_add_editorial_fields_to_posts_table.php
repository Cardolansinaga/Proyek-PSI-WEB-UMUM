<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('meta_title', 70)->nullable()->after('body');
            $table->string('meta_description', 180)->nullable()->after('meta_title');
            $table->softDeletes();
            $table->index(['status', 'published_at']);
            $table->index(['category', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['category', 'status']);
            $table->dropColumn(['meta_title', 'meta_description']);
            $table->dropSoftDeletes();
        });
    }
};
