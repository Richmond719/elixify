<!-- Footer -->
<footer class="site-footer mt-auto bg-white border-top">
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-start gap-3">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="bi bi-lightning-charge text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">Elixify</h6>
                        <p class="mb-0 small text-muted">Connecting Ghanaian talent with great companies. Simple job management for modern teams.</p>
                    </div>
                </div>
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
                <div class="small text-muted mb-2">support@elixify.example • +233 24 000 0000</div>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-secondary btn-sm p-1" aria-label="Twitter" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="btn btn-outline-secondary btn-sm p-1" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                    <a href="https://web.facebook.com/ri.chi.581660/" class="btn btn-outline-secondary btn-sm p-1" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom bg-light py-2 border-top">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center small text-muted">
            <div>&copy; {{ date('Y') }} Elixify. All rights reserved.</div>
            <div class="mt-1 mt-md-0 d-flex align-items-center gap-3">
                <span id="footer-sync" data-timestamp="{{ now()->toIsoString() }}">Last sync: <span class="fw-medium">{{ now()->diffForHumans() }}</span></span>
                <span class="text-muted">•</span>
                <div>Built with <span class="text-danger">&hearts;</span> in Ghana</div>
            </div>
        </div>
    </div>
</footer>
