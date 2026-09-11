<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->after('status');
            $table->index('sort_order');
        });

        DB::table('packages')
            ->orderBy('created_at')
            ->orderBy('id')
            ->get(['id'])
            ->each(function (object $package, int $index): void {
                DB::table('packages')
                    ->where('id', $package->id)
                    ->update(['sort_order' => $index]);
            });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropIndex(['sort_order']);
            $table->dropColumn('sort_order');
        });
    }
};
