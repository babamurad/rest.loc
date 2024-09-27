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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('slug');
            $table->string('thumb_image')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('offer_price', 8, 2)->default(0);
            $table->text('short_description');
            $table->text('long_description');
            $table->string('sku')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('show_at_home')->default(false);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
