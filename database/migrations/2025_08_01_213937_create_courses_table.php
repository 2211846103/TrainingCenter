<?php

use App\Models\User;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->enum('skill_level', ["beginner", "intermediate", "professional"]);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('mode', ['online', 'offline'])->default('offline');
            $table->string('location')->nullable();
            $table->foreignIdFor(User::class, 'instructor_id')->constrained()->cascadeOnDelete();
            $table->decimal('price', 8, 2)->default(0);
            $table->string('category')->nullable();
            $table->unsignedInteger('capacity')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('certified')->default(false);
            $table->string('stripe_price_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
