<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255', Rule::unique('companies', 'name')->ignore($this->company)],
            'address' => ['required', 'min:5', 'max:255'],
            'contact' => ['required', 'min_digits:10', 'max_digits:255', 'numeric', Rule::unique('companies', 'contact')->ignore($this->company)],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('contact')) {
            $contact = $this->input('contact');
            // strip any non-digit characters (e.g. '+', spaces, dashes)
            $digits = preg_replace('/\D+/', '', $contact);
            $this->merge([
                'contact' => $digits,
            ]);
        }
    }

    public function attributes()
    {
        return [
            'name' => 'company name'
        ];
    }
}
