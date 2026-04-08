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
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('customer');
            $table->string('phone')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('restaurant_name')->unique();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->string('item_name');
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->boolean('availability')->default(true);
            $table->timestamps();
        });

        schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('label')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });

        schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('restaurant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->dateTime('order_date')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });

        schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('menu_item_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('restaurants');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
