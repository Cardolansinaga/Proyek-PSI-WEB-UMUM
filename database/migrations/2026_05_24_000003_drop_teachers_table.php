<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Intentionally retained. Legacy teacher data must never be removed by
        // a routine production deployment without a separately approved,
        // verified backup and data-retention decision from the school.
    }

    public function down(): void
    {
        //
    }
};
