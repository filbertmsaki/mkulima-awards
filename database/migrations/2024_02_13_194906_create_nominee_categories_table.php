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
        Schema::create('nominee_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->uuid('nominee_id');
            $table->year('year');
            $table->timestamps();
            $table->foreign('nominee_id')->references('id')->on('nominees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('award_categories')->onUpdate('cascade')->onDelete('cascade');
        });

        if (Schema::hasColumn('nominees', 'category_id')) {
            Schema::table('nominees', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }
        Schema::table('nominees', function (Blueprint $table) {
            $table->string('contact_person_name')->nullable()->change();
            $table->string('contact_person_phone')->nullable()->change();
            $table->string('contact_person_email')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominee_categories');
    }
};
