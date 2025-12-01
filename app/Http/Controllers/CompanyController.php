<?php

namespace App\Http\Controllers;



use App\Models\Company;
use App\Http\Requests\CompanyCreateRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 5);
        $perPage = in_array($perPage, [5, 10, 25]) ? $perPage : 5;

        $query = Company::query();
        if ($q = $request->input('q')) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('address', 'like', "%{$q}%");
        }

        $companies = $query->orderBy('name')->paginate($perPage)->withQueryString();

        return view('admin.companies.index', compact('companies', 'perPage'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect(route('admin.companies.index'))->with('status', [
            'message' => "Company $company->name has been deleted successfully",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $company = Company::create($request->validated());
        return redirect(route('admin.companies.index'))->with('status', [
            'message' => $company->name . ' created successfully',
            'error' => false
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', [
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyCreateRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect(route('admin.companies.index'))->with('status', [
            'message' => $company->name . ' updated successfully',
            'error' => false
        ]);
    }

}
