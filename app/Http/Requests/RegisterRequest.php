<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(6)
                // ->letters()
                // ->mixedCase()
                // ->numbers()
                // ->symbols()
                ->uncompromised()],
            'contact' => ['required', 'regex:/^(\+233|0)[0-9]{9}$/'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'role' => ['required', 'in:admin,job_seeker']
        ];
    }
}
