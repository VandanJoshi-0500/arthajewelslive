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
        Schema::table('collections', function (Blueprint $table) {
            if (!Schema::hasColumn('collections', 'ring_image')) {
                $table->string('ring_image')->nullable();
            }
            if (!Schema::hasColumn('collections', 'necklace_image')) {
                $table->string('necklace_image')->nullable();
            }
            if (!Schema::hasColumn('collections', 'ear_jewelry_mage')) {
                $table->string('ear_jewelry_mage')->nullable();
            }
            if (!Schema::hasColumn('collections', 'bracelets_image')) {
                $table->string('bracelets_image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            if (Schema::hasColumn('collections', 'ring_image')) {
                $table->dropColumn('ring_image');
            }
            if (Schema::hasColumn('collections', 'necklace_image')) {
                $table->dropColumn('necklace_image');
            }
            if (Schema::hasColumn('collections', 'ear_jewelry_mage')) {
                $table->dropColumn('ear_jewelry_mage');
            }
            if (Schema::hasColumn('collections', 'bracelets_image')) {
                $table->dropColumn('bracelets_image');
            }
        });
    }
};
