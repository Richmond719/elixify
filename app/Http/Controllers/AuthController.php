<?php
namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //
    public function registrationPage()
    {
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = $request->role;
        $user = User::create($data);
        Auth::login($user);
        return redirect('/')->with('success', 'Account created successfully! Welcome to Elixify.');
    }
    public function loginPage()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:admin,job_seeker'],
        ]);

        // Find the user and verify they have the selected role
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || $user->role !== $credentials['role']) {
            return back()->withErrors([
                'email' => 'The email and role do not match our records.',
            ])->onlyInput('email', 'role');
        }

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome back, ' . Auth::user()->fullname . '!');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email', 'role');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}

