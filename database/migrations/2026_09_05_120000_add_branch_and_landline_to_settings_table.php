<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('branch_address')->nullable()->after('address');
            $table->string('landline_1')->nullable()->after('phone_secondary');
            $table->string('landline_2')->nullable()->after('landline_1');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['branch_address', 'landline_1', 'landline_2']);
        });
    }
};