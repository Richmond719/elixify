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
        Schema::table('job_postings', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('job_postings', 'salary')) {
                $table->string('salary')->nullable()->after('location');
            }
            if (!Schema::hasColumn('job_postings', 'classification')) {
                $table->string('classification')->nullable()->after('salary');
            }
            if (!Schema::hasColumn('job_postings', 'status')) {
                $table->string('status')->default('active')->after('classification');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn(['salary', 'classification', 'status']);
        });
    }
};
