<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_id')->nullable()->after('name');
            $table->string('name_en')->nullable()->after('name_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['module_type', 'name', 'deleted_at']);
            $table->unique(['module_type', 'name_id', 'deleted_at']);
            $table->unique(['module_type', 'name_en', 'deleted_at']);
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['module_type', 'name_id', 'deleted_at']);
            $table->dropUnique(['module_type', 'name_en', 'deleted_at']);
            $table->unique(['module_type', 'name', 'deleted_at']);
            $table->dropColumn(['name_id', 'name_en']);
        });
    }
};
