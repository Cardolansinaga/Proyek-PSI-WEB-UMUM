<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('password');
            $table->boolean('must_change_password')->default(false)->after('is_admin');
            $table->timestamp('password_changed_at')->nullable()->after('must_change_password');
        });

        // Existing accounts predate the secure bootstrap flow and must rotate
        // their password once before they can access protected admin pages.
        DB::table('users')->update(['must_change_password' => true]);
        DB::table('users')
            ->whereRaw('LOWER(email) = ?', [strtolower((string) config('admin.email'))])
            ->update(['is_admin' => true]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_admin', 'must_change_password', 'password_changed_at']);
        });
    }
};
