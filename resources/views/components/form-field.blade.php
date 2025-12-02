<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-bold">{{ $label ?? $name }}</label>
    <input name="{{ $name }}" value="{{ old($name, $value ?? '') }}" type="{{ $type ?? 'text' }}"
        placeholder="Enter {{ $label ?? $name }}" class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}Field">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
