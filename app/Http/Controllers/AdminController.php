<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPosting;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Real-time metrics calculation
        $totalCompanies = Company::count();
        $totalJobPostings = JobPosting::count();
        $totalApplications = JobApplication::count();
        $totalUsers = User::count();

        // Calculate conversion rate: applications / job postings * 100
        $conversionRate = $totalJobPostings > 0
            ? round(($totalApplications / $totalJobPostings) * 100, 1)
            : 0;

        // Platform activity: percentage of active job postings with applications
        $activePostingsWithApps = JobPosting::whereHas('applications')->count();
        $platformActivity = $totalJobPostings > 0
            ? round(($activePostingsWithApps / $totalJobPostings) * 100, 1)
            : 0;

        // User satisfaction: based on application approval ratio (mock calculation)
        $approvedApplications = JobApplication::where('status', 'approved')->count();
        $userSatisfaction = $totalApplications > 0
            ? round(($approvedApplications / $totalApplications) * 100, 1)
            : 0;

        // Last update timestamp
        $lastUpdate = now();

        // Real-time chart data: Applications per month for last 6 months
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $chartLabels[] = $date->format('M');

            // Count applications created in this month
            $monthApplications = JobApplication::whereBetween('created_at', [
                $date->startOfMonth(),
                $date->endOfMonth()
            ])->count();

            $chartData[] = $monthApplications;
        }

        return view('admin.dashboard.index', [
            'totalCompanies' => $totalCompanies,
            'totalJobPostings' => $totalJobPostings,
            'totalApplications' => $totalApplications,
            'newUsers' => $totalUsers,
            'conversionRate' => $conversionRate,
            'platformActivity' => $platformActivity,
            'userSatisfaction' => $userSatisfaction,
            'lastUpdate' => $lastUpdate,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }

    /**
     * Show the current admin user's profile.
     */
    public function profile()
    {
        $user = Auth::user();

        return view('admin.profile', ['user' => $user]);
    }
}
