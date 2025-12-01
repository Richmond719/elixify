@extends('admin.layout.master')
@section('title')@endsection
@section('content')


    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="header-left">
            <h2 class="mb-1 fw-bold text-dark">Registered Companies</h2>
            <p class="text-muted mb-0">Manage companies, view open positions and recent activity.</p>
        </div>

        <div class="header-right d-flex align-items-center gap-2">
            <form class="search-form d-flex shadow-sm rounded overflow-hidden bg-white" method="GET">
                <span class="input-group-text bg-white border-end-0 px-3"><i class="bi bi-search"></i></span>
                <input name="q" value="{{ request('q') }}" type="text" class="form-control border-start-0" placeholder="Search companies by name or city...">
            </form>

            <!-- Add Company: visible on tablet and up, hidden on mobile -->
            <a href="{{ route('admin.companies.create') }}" class="btn btn-dark btn-sm d-none d-md-inline-flex align-items-center d-lg-none">
                <i class="bi bi-plus-circle me-2"></i> Add Company
            </a>
            <!-- Add Company: visible only on desktop (large and up) -->
            <a href="{{ route('admin.companies.create') }}" class="btn btn-dark btn-sm d-none d-lg-inline-flex align-items-center">
                <i class="bi bi-plus-circle me-2"></i> Add Company
            </a>
        </div>
    </div>

    @if($companies->total())
        <div class="listing-controls d-flex justify-content-end align-items-center mb-3">
            <div class="controls-right d-flex align-items-center gap-3">
                <form method="get" class="d-flex align-items-center align-items-sm-center per-page-control" style="gap:.5rem;">
                    <label class="visually-hidden" for="per_page_select">Items per page</label>
                    <div class="per-page-inner d-flex align-items-center">
                        <span class="per-page-label d-none d-sm-inline small text-muted me-2">Per page</span>
                        <select id="per_page_select" name="per_page" onchange="this.form.submit()" class="per-page-select" aria-label="Items per page selector">
                            <option value="5" {{ (isset($perPage) && $perPage==5) ? 'selected' : '' }}>5</option>
                            <option value="10" {{ (isset($perPage) && $perPage==10) ? 'selected' : '' }}>10</option>
                            <option value="25" {{ (isset($perPage) && $perPage==25) ? 'selected' : '' }}>25</option>
                        </select>
                    </div>
                    @foreach(request()->except(['per_page','page']) as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                </form>
            </div>
        </div>
    @endif

    <!-- Companies Grid -->
    <div class="row g-4 companies-grid">
        @forelse($companies as $company)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card company-card h-100 border-0 shadow-sm position-relative overflow-hidden">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:64px;height:64px;">
                                <i class="bi bi-building fs-2 text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fw-bold text-dark">{{ $company->name }}</h5>
                                <div class="small text-muted">{{ $company->address }}</div>
                            </div>
                            <!-- actions removed from header for cleaner layout; use inline buttons below -->
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-success">{{ $company->job_postings->count() }} Jobs</span>
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="badge bg-light text-dark border">Website</a>
                            @endif
                            <span class="badge bg-light text-dark border">{{ $company->contact }}</span>
                        </div>

                        <p class="text-muted small mb-3">{{ \Illuminate\Support\Str::limit($company->about ?? '', 120) }}</p>

                        <div class="company-actions mt-auto d-flex flex-column flex-sm-row gap-2">
                            <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-outline-info btn-sm w-100 w-sm-auto">
                                <i class="bi bi-eye btn-icon" aria-hidden="true"></i>
                                <span class="btn-text">View</span>
                            </a>
                            <a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-primary btn-sm w-100 w-sm-auto">
                                <i class="bi bi-pencil btn-icon" aria-hidden="true"></i>
                                <span class="btn-text">Edit</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state text-center py-5">
                    <i class="bi bi-building" style="font-size:3rem;color:#ccc;"></i>
                    <h5 class="text-muted mt-4 fw-bold">No Companies Found</h5>
                    <p class="text-muted mb-4">Add companies to populate this directory.</p>
                    <a href="{{ route('admin.companies.create') }}" class="btn btn-dark btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Create First Company
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Centered Pagination at Bottom -->
    @if($companies->total())
        <div class="d-flex justify-content-center mt-5 mb-4">
            <nav class="pagination-wrapper" aria-label="Companies pagination">
                {{ $companies->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    @endif

    <!-- Floating Add Button for Mobile only -->
    <a href="{{ route('admin.companies.create') }}" class="btn btn-dark rounded-circle shadow-lg position-fixed d-lg-none add-company-fab" style="bottom:1.5rem;right:1rem;left:auto;z-index:1050;max-width:56px;max-height:56px;width:56px;height:56px;">
        <i class="bi bi-plus fs-3"></i>
    </a>
    <!-- Add/Edit Company Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-bottom py-3">
                    <h5 class="modal-title fw-bold text-dark">Add New Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.companies.store') }}" id="companyForm">
                        @csrf
                        <div class="mb-3">
                            <label for="companyName" class="form-label fw-bold">Company Name</label>
                            <input name="name" value="{{ old('name') }}" type="text" required minlength="3" maxlength="255"
                                class="form-control @error('name') is-invalid @enderror" id="companyName">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="companyAddress" class="form-label fw-bold">Company Address</label>
                            <input name="address" value="{{ old('address') }}" type="text" required minlength="5" maxlength="255"
                                class="form-control @error('address') is-invalid @enderror" id="companyAddress">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="companyContact" class="form-label fw-bold">Company Contact</label>
                            <input name="contact" value="{{ old('contact') }}" type="tel" required minlength="10" maxlength="255" inputmode="numeric" pattern="\d{10,}"
                                class="form-control @error('contact') is-invalid @enderror" id="companyContact">
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top py-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark" form="companyForm">Save Company</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteCompany(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + id);
                    if (form) form.submit();
                }
            });
        }
    </script>
    <script>
        // Remove any leftover "Showing X to Y of Z results" elements that may be injected
        (function(){
            document.addEventListener('DOMContentLoaded', function () {
                try {
                    document.querySelectorAll('p.small.text-muted, div.small.text-muted, span.small.text-muted').forEach(function(el){
                        if(el.textContent && /Showing\s+\d+/i.test(el.textContent.trim())){
                            el.remove();
                        }
                    });
                } catch (e) {
                    // fail silently
                }
            });
        })();
    </script>
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalEl = document.getElementById('addCompanyModal');
                if (modalEl) {
                    var bsModal = new bootstrap.Modal(modalEl);
                    bsModal.show();
                }
            });
        </script>
    @endif
@endsection
