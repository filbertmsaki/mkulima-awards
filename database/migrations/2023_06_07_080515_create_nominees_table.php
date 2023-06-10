<?php

use App\Enums\VerifiedEnum;
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
        Schema::create('nominees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->string('entry');
            $table->string('service_name');
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('contact_person_name');
            $table->string('contact_person_phone');
            $table->string('contact_person_email');
            $table->string('address');
            $table->string('description');
            $table->string('verified')->default(VerifiedEnum::No->value);

            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('award_categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominees');
    }
};
