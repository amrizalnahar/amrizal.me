<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en')->nullable();
            $table->string('issuer_name');
            $table->string('issuer_logo')->nullable();
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->date('issued_at');
            $table->date('expired_at')->nullable();
            $table->string('verify_url')->nullable();
            $table->string('certificate_image')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
