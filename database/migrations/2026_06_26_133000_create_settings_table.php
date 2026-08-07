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
    Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('restaurant_name')->default('بيت أهلنا');
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();

            $table->text('description')->nullable();

            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();

            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();

            $table->string('working_days')->nullable();

            $table->decimal('delivery_fee',8,2)->default(0);
            $table->decimal('minimum_order',8,2)->default(0);

            $table->boolean('orders_enabled')->default(true);

            $table->boolean('cash_payment')->default(true);
            $table->boolean('online_payment')->default(false);

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();

            $table->string('theme_color')->default('#fd6a34');

            $table->text('welcome_message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
