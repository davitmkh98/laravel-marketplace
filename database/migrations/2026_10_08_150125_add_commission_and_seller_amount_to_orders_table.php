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
    Schema::table('orders', function (Blueprint $table) {
        $table->decimal('commission', 10, 2)->default(0)->after('total');
        $table->decimal('seller_amount', 10, 2)->default(0)->after('commission');
    });
}

    /**
     * Reverse the migrations.
     */
 public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['commission', 'seller_amount']);
    });
}
};
