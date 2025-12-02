<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the user's job applications (web view).
     */
    public function index(Request $request)
    {
        // For authenticated users (job seekers), show their applications
        if (Auth::check() && Auth::user()->isJobSeeker()) {
            $applications = Auth::user()->jobApplications()->with('jobPosting', 'jobPosting.company')->paginate(12);
            return view('job-applications.index', ['applications' => $applications]);
        }

        // For admins, show all applications
        if (Auth::check() && Auth::user()->isAdmin()) {
            $applications = JobApplication::with('jobPosting', 'jobPosting.company')->paginate(12);
            return view('admin.job_applications.index', ['applications' => $applications]);
        }

        // Redirect non-authenticated users to login
        return redirect()->route('auth.login.page');
    }

    /**
     * Show the form for creating a new job application.
     */
    public function create()
    {
        // This would be used for unauthenticated applications, not needed for this flow
        return abort(404);
    }

    /**
     * Store a newly created job application in storage.
     */
    public function store(Request $request)
    {
        // Ensure user is authenticated and is a job seeker
        if (!Auth::check() || !Auth::user()->isJobSeeker()) {
            return redirect()->route('auth.login.page')->with('error', 'Only job seekers can apply for jobs.');
        }

        $validated = $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'cover_letter' => 'nullable|string|max:2000',
        ]);

        // Check if user already applied for this job
        $existing = JobApplication::where('user_id', Auth::id())
            ->where('job_posting_id', $validated['job_posting_id'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already applied for this job.');
        }

        // Create the application
        $validated['user_id'] = Auth::id();
        $validated['applicant_name'] = Auth::user()->fullname;
        $validated['applicant_email'] = Auth::user()->email;
        $validated['applied_at'] = now();

        JobApplication::create($validated);

        return redirect()->route('job-applications.index')->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified job application.
     */
    public function show(JobApplication $jobApplication)
    {
        // Only allow the job seeker who applied or admins to view
        if (Auth::id() !== $jobApplication->user_id && !Auth::user()?->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('job-applications.show', ['application' => $jobApplication->load('jobPosting', 'jobPosting.company')]);
    }

    /**
     * Show the form for editing the specified job application.
     */
    public function edit(JobApplication $jobApplication)
    {
        // Only allow the job seeker who applied or admins to edit
        if (Auth::id() !== $jobApplication->user_id && !Auth::user()?->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('job-applications.edit', ['application' => $jobApplication]);
    }

    /**
     * Update the specified job application in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        // Only allow the job seeker who applied or admins to update
        if (Auth::id() !== $jobApplication->user_id && !Auth::user()?->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'status' => Auth::user()?->isAdmin() ? 'nullable|in:pending,reviewing,accepted,rejected' : 'nullable',
        ]);

        $jobApplication->update($validated);

        return back()->with('success', 'Application updated successfully!');
    }

    /**
     * Remove the specified job application from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        // Only allow the job seeker who applied or admins to delete
        if (Auth::id() !== $jobApplication->user_id && !Auth::user()?->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $jobApplication->delete();

        return back()->with('success', 'Application deleted successfully!');
    }
}
