

<footer class="site-footer bg-dark text-white pt-5 pb-3 border-top mt-5">
    <div class="container">
        <div class="row align-items-start gy-4">
            <div class="col-12 col-md-4">
                <h5 class="fw-bold mb-2">Elixify</h5>
                <p class="mb-0 text-muted small">Connecting Ghanaian talent with great companies. Simple job management for modern teams.</p>
            </div>
            <div class="col-12 col-md-4">
                <h6 class="fw-bold small mb-2">Quick Links</h6>
                <ul class="list-unstyled small mb-0">
                    <li><a href="{{ url('/') }}" class="text-muted">Home</a></li>
                    <li><a href="{{ route('admin.companies.index') }}" class="text-muted">Companies</a></li>
                    <li><a href="{{ route('admin.job-postings.index') }}" class="text-muted">Job Postings</a></li>
                    <li><a href="{{ Route::has('contact') ? route('contact') : '#' }}" class="text-muted">Contact</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-4">
                <h6 class="fw-bold small mb-2">Contact & Social</h6>
                <div class="small text-muted mb-2">support@elixify.example &bull; +233 24 000 0000</div>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-secondary btn-sm p-1" aria-label="Twitter" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary btn-sm p-1" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                    <a href="https://web.facebook.com/ri.chi.581660/" class="btn btn-outline-secondary btn-sm p-1" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-top pt-3 mt-4 d-flex flex-column flex-md-row justify-content-between align-items-center small text-muted">
            <div>&copy; {{ date('Y') }} Elixify. All rights reserved.</div>
            <div class="mt-1 mt-md-0 d-flex align-items-center gap-3">
                <span id="footer-sync" data-timestamp="{{ now()->toIsoString() }}">Last sync: <span class="fw-medium">{{ now()->diffForHumans() }}</span></span>
                <span class="text-muted">&bull;</span>
                <div>Built with <span class="text-danger">&hearts;</span> in Ghana</div>
            </div>
        </div>
    </div>
</footer>
