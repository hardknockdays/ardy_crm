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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreign(['lead_id'], 'fk_projects_lead')->references(['id'])->on('leads')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['sales_id'], 'fk_projects_sales')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('fk_projects_lead');
            $table->dropForeign('fk_projects_sales');
        });
    }
};
