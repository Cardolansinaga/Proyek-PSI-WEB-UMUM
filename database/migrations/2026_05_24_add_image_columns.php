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
        // Add image_path to achievements table
        if (Schema::hasTable('achievements')) {
            Schema::table('achievements', function (Blueprint $table) {
                if (!Schema::hasColumn('achievements', 'image_path')) {
                    $table->string('image_path')->nullable()->after('image_class');
                }
            });
        }

        // Add image_path to activities table
        if (Schema::hasTable('activities')) {
            Schema::table('activities', function (Blueprint $table) {
                if (!Schema::hasColumn('activities', 'image_path')) {
                    $table->string('image_path')->nullable()->after('image_class');
                }
            });
        }

        // Add image_path to galleries table
        if (Schema::hasTable('galleries')) {
            Schema::table('galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('galleries', 'image_path')) {
                    $table->string('image_path')->nullable()->after('image_class');
                }
            });
        }

        // Add image_path to posts table
        if (Schema::hasTable('posts')) {
            Schema::table('posts', function (Blueprint $table) {
                if (!Schema::hasColumn('posts', 'image_path')) {
                    $table->string('image_path')->nullable()->after('image_class');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            if (Schema::hasColumn('achievements', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('activities', function (Blueprint $table) {
            if (Schema::hasColumn('activities', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('galleries', function (Blueprint $table) {
            if (Schema::hasColumn('galleries', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }
};
