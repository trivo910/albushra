<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_image_1')->nullable()->after('gtm_code');
            $table->string('hero_image_2')->nullable()->after('hero_image_1');
            $table->string('hero_image_3')->nullable()->after('hero_image_2');
            $table->string('meta_title')->nullable()->after('hero_image_3');
            $table->string('meta_description')->nullable()->after('meta_title');
            $table->text('map_embed')->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['hero_image_1', 'hero_image_2', 'hero_image_3', 'meta_title', 'meta_description', 'map_embed']);
        });
    }
};
