<?php
namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function homepage(Request $request)
    {
        // If the job_postings table doesn't exist yet (migrations not run),
        // return an empty paginator to avoid an exception in the view.
        if (!Schema::hasTable('job_postings')) {
            $empty = [];
            $paginator = new LengthAwarePaginator($empty, 0, 9, 1, [
                'path' => url()->current(),
            ]);

            return view('home', [
                'jobpostings' => $paginator,
            ]);
        }

        try {
            // Simple search by title
            $query = JobPosting::query();
            if ($request->filled('q')) {
                $q = $request->input('q');
                $query->where('title', 'like', "%{$q}%");
            }

            $jobpostings = $query->orderBy('created_at', 'desc')->paginate(9)->withQueryString();

            return view('home', [
                'jobpostings' => $jobpostings,
            ]);
        } catch (QueryException $e) {
            // If there's a DB error, return an empty paginator and log the error.
            Log::error('HomeController::homepage DB error: ' . $e->getMessage());

            $empty = [];
            $paginator = new LengthAwarePaginator($empty, 0, 9, 1, [
                'path' => url()->current(),
            ]);

            return view('home', [
                'jobpostings' => $paginator,
            ]);
        }
    }
}

