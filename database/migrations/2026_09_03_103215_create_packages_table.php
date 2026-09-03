<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['hajj', 'umrah']);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('duration')->nullable();
            $table->string('tour_type')->nullable();
            $table->string('group_size')->nullable();
            $table->string('languages')->nullable();
            $table->longText('description')->nullable();
            $table->json('included')->nullable();
            $table->json('excluded')->nullable();
            $table->text('map_embed')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
