<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('job_posting_id');
            $table->foreign('job_posting_id')->references('id')->on('job_postings')->onDelete('cascade');
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->text('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->string('status')->default('submitted');
            $table->timestamp('applied_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};
