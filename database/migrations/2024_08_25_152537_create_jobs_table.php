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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_type_id')->constrained()->onDelete('cascade');
            $table->integer('vacancy');
            $table->string('salary')->nullable();
            $table->string('location');
            $table->string('experience');
            $table->text('description')->nullable();
            $table->text('benefits')->nullable();
            $table->text('responsibilty')->nullable();
            $table->text('qualification')->nullable();
            $table->string('company_name');
            $table->string('main_branch')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
