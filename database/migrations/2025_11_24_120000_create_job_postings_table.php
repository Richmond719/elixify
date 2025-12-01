<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->uuid('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('employment_type')->nullable();
            $table->decimal('salary_from', 12, 2)->nullable();
            $table->decimal('salary_to', 12, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_postings');
    }
};
