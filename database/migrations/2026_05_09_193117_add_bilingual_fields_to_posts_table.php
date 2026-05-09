<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('title', 'title_id');
            $table->renameColumn('content', 'content_id');
            $table->string('title_en')->nullable()->after('title_id');
            $table->longText('content_en')->nullable()->after('content_id');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('title_id', 'title');
            $table->renameColumn('content_id', 'content');
            $table->dropColumn('title_en');
            $table->dropColumn('content_en');
        });
    }
};