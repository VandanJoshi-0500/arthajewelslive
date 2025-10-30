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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('mobile')->nullable();
            $table->bigInteger('role');
            $table->text('image')->nullable();
            $table->text('address')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('streetaddress')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->bigInteger('status')->default('0');
            $table->integer('user_group')->default(0);
            $table->string('fax')->nullable();
            $table->integer('discount_percentage')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_login_ip_address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
