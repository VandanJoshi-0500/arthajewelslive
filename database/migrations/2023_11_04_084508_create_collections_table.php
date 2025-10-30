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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('order_no')->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->string('ugi_term')->nullable();
            $table->integer('parent')->default(0);
            $table->text('description')->nullable();
            $table->integer('image_type')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->text('menu_image')->nullable();
            $table->string('meta_text')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('keyword')->nullable();
            $table->integer('active')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
