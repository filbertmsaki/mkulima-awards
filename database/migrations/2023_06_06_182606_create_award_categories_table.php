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
        Schema::create('award_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->uuid('created_by');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('award_categories');
    }
};
