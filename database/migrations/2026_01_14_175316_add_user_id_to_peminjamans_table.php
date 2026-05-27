<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('peminjamans', 'user_id')) {
            Schema::table('peminjamans', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->after('id')
                    ->constrained()
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        // No-op: user_id is part of the base peminjamans table in the current schema.
    }
};
