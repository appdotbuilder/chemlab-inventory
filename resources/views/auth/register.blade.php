@extends('layouts.app')

@section('title', 'Register - ChemLab')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8" data-aos="fade-up">
        <!-- Logo and Header -->
        <div class="text-center">
            <div class="mb-6" data-aos="zoom-in">
                <lottie-player
                    src="https://assets9.lottiefiles.com/packages/lf20_DMgKk1.json"
                    background="transparent"
                    speed="1"
                    style="width: 80px; height: 80px; margin: 0 auto;"
                    loop
                    autoplay>
                </lottie-player>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                📝 Create Account
            </h2>
            <p class="text-gray-600 dark:text-gray-300">
                Join ChemLab - Laboratory Equipment Management System
            </p>
        </div>

        <!-- Registration Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="200">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Personal Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        👤 Personal Information
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Full Name *
                            </label>
                            <input id="name" 
                                   name="name" 
                                   type="text" 
                                   autocomplete="name" 
                                   required 
                                   value="{{ old('name') }}"
                                   class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror"
                                   placeholder="Enter your full name">
                            @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                📧 Email Address *
                            </label>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   autocomplete="email" 
                                   required 
                                   value="{{ old('email') }}"
                                   class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                                   placeholder="your.email@ui.ac.id">
                            @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        🎓 Academic Information
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Student ID / Employee ID -->
                        <div>
                            <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Student ID / Employee ID *
                            </label>
                            <input id="student_id" 
                                   name="student_id" 
                                   type="text" 
                                   required 
                                   value="{{ old('student_id') }}"
                                   class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('student_id') border-red-500 @enderror"
                                   placeholder="e.g. 1234567890 or EMP001">
                            @error('student_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Role *
                            </label>
                            <select id="role" 
                                    name="role" 
                                    required
                                    class="select2 w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-500 @enderror">
                                <option value="">Select your role</option>
                                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>🎓 Student</option>
                                <option value="lecturer" {{ old('role') === 'lecturer' ? 'selected' : '' }}>👨‍🏫 Lecturer</option>
                                <option value="lab_assistant" {{ old('role') === 'lab_assistant' ? 'selected' : '' }}>🔧 Lab Assistant</option>
                                <option value="head_of_lab" {{ old('role') === 'head_of_lab' ? 'selected' : '' }}>🧬 Head of Lab</option>
                            </select>
                            @error('role')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <!-- Department/Program -->
                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Department/Program
                            </label>
                            <input id="department" 
                                   name="department" 
                                   type="text" 
                                   value="{{ old('department', 'Chemical Engineering') }}"
                                   class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="e.g. Chemical Engineering">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                📱 Phone Number
                            </label>
                            <input id="phone" 
                                   name="phone" 
                                   type="tel" 
                                   value="{{ old('phone') }}"
                                   class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="+62 812 3456 7890">
                        </div>
                    </div>
                </div>

                <!-- Security Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        🔒 Security Information
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Password *
                            </label>
                            <div class="relative">
                                <input id="password" 
                                       name="password" 
                                       type="password" 
                                       autocomplete="new-password" 
                                       required
                                       class="w-full px-3 py-3 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                                       placeholder="Create a strong password">
                                <button type="button" 
                                        onclick="togglePassword('password')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <span id="password-toggle" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">👁️</span>
                                </button>
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Confirm Password *
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" 
                                       name="password_confirmation" 
                                       type="password" 
                                       autocomplete="new-password" 
                                       required
                                       class="w-full px-3 py-3 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                       placeholder="Confirm your password">
                                <button type="button" 
                                        onclick="togglePassword('password_confirmation')" 
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <span id="password-confirmation-toggle" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">👁️</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <p class="mb-2">Password must contain:</p>
                        <ul class="list-disc list-inside space-y-1 ml-4">
                            <li>At least 8 characters</li>
                            <li>One uppercase letter</li>
                            <li>One lowercase letter</li>
                            <li>One number</li>
                        </ul>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" 
                                   name="terms" 
                                   type="checkbox" 
                                   required
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-900 dark:text-gray-300">
                                I agree to the 
                                <a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                    Terms of Service
                                </a> 
                                and 
                                <a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                    Privacy Policy
                                </a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <span class="text-blue-500 group-hover:text-blue-400 text-lg">🚀</span>
                        </span>
                        Create Account
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                            Already have an account?
                        </span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <a href="{{ route('login') }}" 
                       class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                        🔐 Sign in to your account
                    </a>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="text-center text-sm text-gray-500 dark:text-gray-400" data-aos="fade-up" data-aos-delay="400">
            <p class="mb-2">🏛️ Department of Chemical Engineering</p>
            <p>Faculty of Engineering, University of Indonesia</p>
        </div>

        <!-- Registration Notice -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4" data-aos="fade-up" data-aos-delay="600">
            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-200 mb-2">ℹ️ Registration Notice</h4>
            <p class="text-xs text-blue-700 dark:text-blue-300">
                Your account will be reviewed by administrators before activation. 
                You will receive an email notification once your account is approved.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(fieldId + '-toggle');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = '🙈';
    } else {
        passwordField.type = 'password';
        toggleIcon.textContent = '👁️';
    }
}

// Password strength indicator
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    
    // Password matching validation
    confirmPasswordField.addEventListener('input', function() {
        if (passwordField.value !== confirmPasswordField.value) {
            confirmPasswordField.setCustomValidity('Passwords do not match');
        } else {
            confirmPasswordField.setCustomValidity('');
        }
    });
    
    passwordField.addEventListener('input', function() {
        if (confirmPasswordField.value && passwordField.value !== confirmPasswordField.value) {
            confirmPasswordField.setCustomValidity('Passwords do not match');
        } else {
            confirmPasswordField.setCustomValidity('');
        }
    });
});
</script>
@endpush
@endsection