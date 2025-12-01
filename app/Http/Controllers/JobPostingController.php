<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobPostingResource;
use App\Models\JobPosting;
use App\Models\Company;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    public function index()
    {
        $query = JobPosting::with('company', 'applications');

        // Default to Ghana-only listings unless the `all` query param is present
        if (!request()->has('all')) {
            $query->where('location', 'like', '%Ghana%')
                  ->orWhere('location', 'ilike', '%Accra%')
                  ->orWhere('location', 'ilike', '%Kumasi%')
                  ->orWhere('location', 'ilike', '%Tema%')
                  ->orWhere('location', 'ilike', '%Takoradi%')
                  ->orWhere('location', 'ilike', '%Tamale%');
        }

        $jobPostings = $query->paginate(12)->withQueryString();

        return view('admin.job_postings.index', ['jobPostings' => $jobPostings]);
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.job_postings.create', ['companies' => $companies]);
    }

    public function show(JobPosting $jobPosting)
    {
        return view('admin.job_postings.show', ['jobPosting' => $jobPosting->load('company', 'applications')]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:5000',
            'location' => 'required|string|min:3|max:255',
            'salary' => 'nullable|string|max:255',
            'classification' => 'nullable|string|max:255',
            'company_id' => 'required|uuid|exists:companies,id',
            'status' => 'sometimes|in:active,closed,draft',
        ]);

        try {
            $jobPosting = JobPosting::create($validated);

            return redirect()
                ->route('admin.job_postings.show', $jobPosting)
                ->with('status', [
                    'message' => 'Job posting created successfully!',
                    'error' => false
                ]);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('status', [
                    'message' => 'Error creating job posting: ' . $e->getMessage(),
                    'error' => true
                ]);
        }
    }

    public function edit(JobPosting $jobPosting)
    {
        $companies = Company::all();
        return view('admin.job_postings.edit', ['jobPosting' => $jobPosting, 'companies' => $companies]);
    }

    public function update(Request $request, JobPosting $jobPosting)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:5000',
            'location' => 'required|string|min:3|max:255',
            'salary' => 'nullable|string|max:255',
            'classification' => 'nullable|string|max:255',
            'company_id' => 'required|uuid|exists:companies,id',
            'status' => 'sometimes|in:active,closed,draft',
        ]);

        try {
            $jobPosting->update($validated);

            return redirect()
                ->route('admin.job_postings.show', $jobPosting)
                ->with('status', [
                    'message' => 'Job posting updated successfully!',
                    'error' => false
                ]);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('status', [
                    'message' => 'Error updating job posting: ' . $e->getMessage(),
                    'error' => true
                ]);
        }
    }

    public function destroy(JobPosting $jobPosting)
    {
        try {
            $jobPosting->delete();

            return redirect()
                ->route('admin.job_postings.index')
                ->with('status', [
                    'message' => 'Job posting deleted successfully!',
                    'error' => false
                ]);
        } catch (\Exception $e) {
            return back()
                ->with('status', [
                    'message' => 'Error deleting job posting: ' . $e->getMessage(),
                    'error' => true
                ]);
        }
    }
}
