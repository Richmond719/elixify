<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobApplicationResource;
use App\Models\JobApplication;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = JobApplication::query();

        if ($request->has('job_posting_id')) {
            $query->where('job_posting_id', $request->job_posting_id);
        }

        return JobApplicationResource::collection($query->paginate(15));
    }

    public function show(JobApplication $jobApplication)
    {
        return new JobApplicationResource($jobApplication);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'user_id' => 'nullable|exists:users,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'cover_letter' => 'nullable|string',
            'resume_path' => 'nullable|string',
        ]);

        $data['applied_at'] = now();

        $application = JobApplication::create($data);

        return new JobApplicationResource($application);
    }

    public function update(Request $request, JobApplication $jobApplication)
    {
        $data = $request->validate([
            'status' => 'nullable|string|max:100',
            'cover_letter' => 'nullable|string',
            'resume_path' => 'nullable|string',
        ]);

        $jobApplication->update($data);

        return new JobApplicationResource($jobApplication);
    }

    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        return response()->noContent();
    }
}
