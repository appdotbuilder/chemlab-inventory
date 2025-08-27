@extends('layouts.app')

@section('title', 'Login - ChemLab')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8" data-aos="fade-up">
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
                🔐 Welcome Back
            </h2>
            <p class="text-gray-600 dark:text-gray-300">
                Sign in to your ChemLab account
            </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8" data-aos="fade-up" data-aos-delay="200">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        📧 Email Address
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           autocomplete="email" 
                           required 
                           value="{{ old('email') }}"
                           class="w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror"
                           placeholder="Enter your email address">
                    @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        🔒 Password
                    </label>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="current-password" 
                               required
                               class="w-full px-3 py-3 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                               placeholder="Enter your password">
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <span id="password-toggle" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">👁️</span>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" 
                               name="remember" 
                               type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" 
                           class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                            Forgot your password?
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <span class="text-blue-500 group-hover:text-blue-400 text-lg">🚀</span>
                        </span>
                        Sign In
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                            Don't have an account?
                        </span>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="text-center">
                    <a href="{{ route('register') }}" 
                       class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                        📝 Create new account
                    </a>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="text-center text-sm text-gray-500 dark:text-gray-400" data-aos="fade-up" data-aos-delay="400">
            <p class="mb-2">🏛️ Department of Chemical Engineering</p>
            <p>Faculty of Engineering, University of Indonesia</p>
        </div>

        <!-- Demo Credentials -->
        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4" data-aos="fade-up" data-aos-delay="600">
            <h4 class="text-sm font-semibold text-yellow-800 dark:text-yellow-200 mb-2">🔑 Demo Credentials</h4>
            <div class="text-xs text-yellow-700 dark:text-yellow-300 space-y-1">
                <p><strong>Admin:</strong> admin@chemlab.ui.ac.id / password123</p>
                <p><strong>Student:</strong> student@chemlab.ui.ac.id / password123</p>
                <p><strong>Lab Assistant:</strong> assistant@chemlab.ui.ac.id / password123</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword() {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('password-toggle');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = '🙈';
    } else {
        passwordField.type = 'password';
        toggleIcon.textContent = '👁️';
    }
}

// Auto-fill demo credentials
document.addEventListener('DOMContentLoaded', function() {
    // Add click handlers for demo credentials
    document.addEventListener('click', function(e) {
        if (e.target.textContent.includes('admin@chemlab.ui.ac.id')) {
            document.getElementById('email').value = 'admin@chemlab.ui.ac.id';
            document.getElementById('password').value = 'password123';
        } else if (e.target.textContent.includes('student@chemlab.ui.ac.id')) {
            document.getElementById('email').value = 'student@chemlab.ui.ac.id';
            document.getElementById('password').value = 'password123';
        } else if (e.target.textContent.includes('assistant@chemlab.ui.ac.id')) {
            document.getElementById('email').value = 'assistant@chemlab.ui.ac.id';
            document.getElementById('password').value = 'password123';
        }
    });
});
</script>
@endpush
@endsection