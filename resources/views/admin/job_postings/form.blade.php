@csrf
<div class="row g-3">
    <div class="col-12">
        <label for="title" class="form-label fw-bold">Job Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $jobPosting->title ?? '') }}" placeholder="e.g., Senior PHP/Laravel Developer (Accra)" required minlength="3" maxlength="255">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="company_id" class="form-label fw-bold">Company</label>
        <select class="form-select @error('company_id') is-invalid @enderror" id="company_id" name="company_id" required>
            <option value="">Select a company</option>
            @foreach($companies ?? [] as $company)
                <option value="{{ $company->id }}" @selected(old('company_id', $jobPosting->company_id ?? '') == $company->id)>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        @error('company_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="location" class="form-label fw-bold">Location</label>
        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $jobPosting->location ?? '') }}" placeholder="e.g., Accra, Ghana or Remote" required minlength="3" maxlength="255">
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="salary" class="form-label fw-bold">Salary Range</label>
        <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary', $jobPosting->salary ?? '') }}" placeholder="e.g., GHS 60,000 - GHS 90,000/year or Negotiable">
        @error('salary')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="classification" class="form-label fw-bold">Employment Type</label>
        <select class="form-select @error('classification') is-invalid @enderror" id="classification" name="classification">
            <option value="">Select employment type</option>
            <option value="Full-Time" @selected(old('classification', $jobPosting->classification ?? '') == 'Full-Time')>Full-Time</option>
            <option value="Part-Time" @selected(old('classification', $jobPosting->classification ?? '') == 'Part-Time')>Part-Time</option>
            <option value="Contract" @selected(old('classification', $jobPosting->classification ?? '') == 'Contract')>Contract</option>
            <option value="Temporary" @selected(old('classification', $jobPosting->classification ?? '') == 'Temporary')>Temporary</option>
            <option value="Internship" @selected(old('classification', $jobPosting->classification ?? '') == 'Internship')>Internship</option>
        </select>
        @error('classification')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label fw-bold">Job Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" placeholder="Include responsibilities, required skills, benefits (e.g., NHIS, SSNIT) and local context. Aim for 50-500 words." required minlength="10" maxlength="5000">{{ old('description', $jobPosting->description ?? '') }}</textarea>
        <small class="text-muted">Provide a comprehensive description including role overview, responsibilities, required skills, and any Ghana-specific benefits or requirements.</small>
        @error('description')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 col-md-6">
        <label for="status" class="form-label fw-bold">Status</label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
            <option value="draft" @selected(old('status', $jobPosting->status ?? 'draft') == 'draft')>Draft</option>
            <option value="active" @selected(old('status', $jobPosting->status ?? '') == 'active')>Active (Published)</option>
            <option value="closed" @selected(old('status', $jobPosting->status ?? '') == 'closed')>Closed (Not Hiring)</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <div class="d-flex gap-2 pt-3">
            <button type="submit" class="btn btn-dark">{{ isset($jobPosting) ? 'Update Job Posting' : 'Create Job Posting' }}</button>
            <a href="{{ route('admin.job_postings.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </div>
</div>
