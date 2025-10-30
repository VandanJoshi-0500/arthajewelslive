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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('image_type')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->text('menu_image')->nullable();
            $table->text('description')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('parent')->default('0');
            $table->integer('status')->default('0');
            $table->integer('active')->default(1);
            $table->string('meta_text')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('keyword')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
