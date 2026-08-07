<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_employees', function (Blueprint $table) {
            $table->string('vehicle')->nullable()->after('email');
            $table->string('status')->default('نشط')->after('vehicle');
        });
    }

    public function down(): void
    {
        Schema::table('delivery_employees', function (Blueprint $table) {
            $table->dropColumn(['vehicle', 'status']);
        });
    }
};