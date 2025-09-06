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
        Schema::table('project_items', function (Blueprint $table) {
            $table->foreign(['product_id'], 'fk_items_product')->references(['id'])->on('products')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['project_id'], 'fk_items_project')->references(['id'])->on('projects')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_items', function (Blueprint $table) {
            $table->dropForeign('fk_items_product');
            $table->dropForeign('fk_items_project');
        });
    }
};
