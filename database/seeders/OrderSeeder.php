<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('phone')->nullable();

            $table->decimal('total_price', 8, 2)->default(0);

            $table->string('status')->default('قيد التحضير');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'total_price',
                'status'
            ]);

        });
    }
};