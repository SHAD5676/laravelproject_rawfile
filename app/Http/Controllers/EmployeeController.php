<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{

    public function create()
    {
        return view('auth.employee_login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::guard('employee')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Credentials do not match our records.'
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended('/employee/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/employee/login');
    }
}
