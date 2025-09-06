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
        Schema::table('customer_services', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'fk_services_customer')->references(['id'])->on('customers')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['product_id'], 'fk_services_product')->references(['id'])->on('products')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_services', function (Blueprint $table) {
            $table->dropForeign('fk_services_customer');
            $table->dropForeign('fk_services_product');
        });
    }
};
