<!-- Sidebar -->
<div class="bg-primary border-end text-white" id="sidebar-wrapper">
    <div class="sidebar-heading bg-primary text-white p-3 fw-bold fs-4">Elixify Admin</div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action text-white fw-bold border-0 {{ Request::is('admin/dashboard') ? 'bg-secondary' : 'bg-primary' }}"><i
                class="bi bi-speedometer2 me-2"></i>Dashboard</a>
        <a href="{{ route('admin.job-postings.index') }}" class="list-group-item list-group-item-action text-white border-0 {{ Request::is('admin/job-postings*') ? 'bg-secondary' : 'bg-primary' }}"><i
                class="bi bi-briefcase me-2"></i>Job Listings</a>
        <a href="{{ route('admin.job-applications.index') }}" class="list-group-item list-group-item-action text-white border-0 {{ Request::is('admin/job-applications*') ? 'bg-secondary' : 'bg-primary' }}"><i
                class="bi bi-file-earmark-text me-2"></i>Applications</a>
        <a href="{{ route('admin.companies.index') }}" class="list-group-item list-group-item-action text-white border-0 {{ Request::is('admin/companies*') ? 'bg-secondary' : 'bg-primary' }}"><i
                class="bi bi-building me-2"></i>Companies</a>
        @if(Route::has('admin.settings.index'))
        <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action text-white border-0 {{ Request::is('admin/settings*') ? 'bg-secondary' : 'bg-primary' }}"><i
                class="bi bi-person-gear me-2"></i>Settings</a>
        @endif
    </div>
</div>
