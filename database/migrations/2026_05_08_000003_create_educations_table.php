<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name');
            $table->string('logo')->nullable();
            $table->enum('degree', ['SMA', 'D3', 'S1', 'S2', 'S3']);
            $table->string('major_id');
            $table->string('major_en')->nullable();
            $table->year('started_at');
            $table->year('ended_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
