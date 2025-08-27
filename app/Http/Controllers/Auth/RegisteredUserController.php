<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'student_id' => 'required|string|max:50|unique:users,student_id',
            'role' => 'required|in:student,lecturer,lab_assistant,head_of_lab',
            'department' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'role' => $request->role,
            'department' => $request->department,
            'phone' => $request->phone,
            'status' => 'pending', // New users need approval
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Don't auto-login, redirect to login with success message
        return redirect()->route('login')->with('success', 'Registration successful! Your account is pending approval. You will be notified by email once approved.');
    }
}
