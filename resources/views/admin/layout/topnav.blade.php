 <!-- Top Navigation -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="padding: 1rem 0;">
     <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center w-100">

            <!-- Left side: Sidebar toggle (mobile only) -->
            <div class="d-flex align-items-center" style="flex: 1;">
                <button id="sidebarToggleBtn" class="animated-toggle btn btn-link d-lg-none p-0 me-2" type="button" aria-label="Toggle sidebar" style="font-size:2rem;">
                    <span class="icon-list">
                        <svg width="28" height="28" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect y="3" width="20" height="2" rx="1" fill="currentColor"/>
                            <rect y="9" width="20" height="2" rx="1" fill="currentColor"/>
                            <rect y="15" width="20" height="2" rx="1" fill="currentColor"/>
                        </svg>
                    </span>
                    <span class="icon-close">
                        <svg width="28" height="28" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4.22217" y="3.10059" width="20" height="2" rx="1" transform="rotate(45 4.22217 3.10059)" fill="currentColor"/>
                            <rect x="3.10059" y="15.7782" width="20" height="2" rx="1" transform="rotate(-45 3.10059 15.7782)" fill="currentColor"/>
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Right side: User menu (avatar + dropdown) -->
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="avatar rounded-circle bg-dark text-white d-inline-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:0.95rem;">A</span>
                        <span class="d-none d-sm-inline navbar-text text-muted" style="font-size:0.9rem;">Admin</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userMenuDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                        @if(Route::has('admin.settings.index'))
                            <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        @else
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ Route::has('logout') ? route('logout') : url('/logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
         </div>
     </div>
 </nav>
