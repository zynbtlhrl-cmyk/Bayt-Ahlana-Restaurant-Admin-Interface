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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        // معلومات الزبون
        $table->string('customer_name');
        $table->string('phone')->nullable();
        $table->text('address')->nullable();

        // معلومات الطلب
        $table->decimal('total_price', 8, 2);
        $table->string('status')->default('pending');

        // ملاحظات
        $table->text('notes')->nullable();
         // معلومات الطلب
        $table->string('food_name'); // اسم الأكلة
        $table->integer('quantity'); // الكمية
        // وقت الإنشاء والتحديث
        $table->timestamps();
        
        $table->foreignId('delivery_employee_id')
      ->nullable()
      ->constrained('delivery_employees')
      ->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
