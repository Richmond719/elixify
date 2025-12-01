<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // Create a temporary column to store UUIDs
        Schema::table('job_postings', function (Blueprint $table) {
            $table->uuid('id_new')->nullable();
        });

        // Generate UUIDs for existing records
        DB::table('job_postings')->get()->each(function ($record) {
            DB::table('job_postings')
                ->where('id', $record->id)
                ->update(['id_new' => Str::uuid()]);
        });

        // Update foreign keys in job_applications table
        DB::statement('ALTER TABLE job_applications DISABLE TRIGGER ALL');

        // Create a temporary UUID column in job_applications
        Schema::table('job_applications', function (Blueprint $table) {
            $table->uuid('job_posting_id_new')->nullable();
        });

        DB::table('job_applications')->get()->each(function ($record) {
            $newId = DB::table('job_postings')
                ->where('id', $record->job_posting_id)
                ->value('id_new');

            if ($newId) {
                DB::table('job_applications')
                    ->where('id', $record->id)
                    ->update(['job_posting_id_new' => $newId]);
            }
        });

        DB::statement('ALTER TABLE job_applications ENABLE TRIGGER ALL');

        // Drop the foreign key constraint first
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropForeign(['job_posting_id']);
            $table->dropColumn('job_posting_id');
        });

        // Rename the new UUID column to job_posting_id
        Schema::table('job_applications', function (Blueprint $table) {
            $table->renameColumn('job_posting_id_new', 'job_posting_id');
        });

        // Drop old id column and rename new one
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
        });

        Schema::table('job_postings', function (Blueprint $table) {
            $table->renameColumn('id_new', 'id');
            $table->primary('id');
        });

        // Recreate the foreign key constraint with UUID column
        Schema::table('job_applications', function (Blueprint $table) {
            $table->foreign('job_posting_id')->references('id')->on('job_postings')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Rollback would require storing the original IDs, so this is a one-way migration
        throw new Exception('This migration cannot be rolled back');
    }
};
