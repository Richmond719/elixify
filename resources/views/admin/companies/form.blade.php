<form method="POST" action="{{ $action }}">
    @csrf
    @isset($edit)
        @method('PATCH')
    @endisset
    <div class="mb-3">
        <label for="companyName" class="form-label fw-bold">Company Name</label>
        <input name="name" value="{{ old('name', $company->name ?? '') }}" type="text"
            class="form-control @error('name') is-invalid @enderror" id="companyTitle">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="companyName" class="form-label fw-bold">Company Address</label>
        <input name="address" value="{{ old('address', $company->address ?? '') }}" type="text"
            class="form-control @error('address') is-invalid @enderror" id="companyTitle">
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="companyName" class="form-label fw-bold">Company Contact</label>
        <input name="contact" value="{{ old('contact', $company->contact ?? '') }}" type="text"
            class="form-control @error('contact') is-invalid @enderror" id="companyTitle">
        @error('contact')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary me-2"><i
            class="bi bi-save me-1"></i>{{ $buttonText ?? 'Save Company' }}
    </button>
    <button type="reset" class="btn btn-outline-secondary"><i class="bi bi-x-circle me-1"></i> Clear
        Form</button>
</form>
