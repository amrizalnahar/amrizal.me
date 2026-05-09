<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->enum('type', ['personal', 'office']);
            $table->string('company_name')->nullable();
            $table->text('short_description_id');
            $table->text('short_description_en')->nullable();
            $table->longText('full_description_id');
            $table->longText('full_description_en')->nullable();
            $table->string('role');
            $table->string('period');
            $table->string('demo_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
