<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Company extends Model
{
    use HasUuids;

    /**
     * The type of the primary key ID.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'address',
        'contact',
    ];
    // define relationship with job posting
    public function job_postings()
    {
        return $this->hasMany(JobPosting::class);
    }
    public function job_applications()
    {
        return $this->hasManyThrough(JobApplication::class, JobPosting::class);
    }

    /**
     * Get the job postings for this company.
     */
    public function jobPostings()
    {
        return $this->hasMany(JobPosting::class);
    }
}
