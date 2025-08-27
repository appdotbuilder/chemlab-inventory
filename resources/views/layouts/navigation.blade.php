<!-- Sidebar Navigation -->
<div x-data="{ open: false }" class="relative z-50">
    <!-- Mobile menu button -->
    <button @click="open = !open" 
            class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-white dark:bg-gray-800 shadow-md text-gray-600 dark:text-gray-300">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Mobile backdrop -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="lg:hidden fixed inset-0 bg-gray-600 bg-opacity-75"></div>

    <!-- Sidebar -->
    <div x-show="open" 
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="lg:translate-x-0 lg:static lg:inset-0 fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 shadow-lg lg:shadow-none">
        
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 px-4 bg-blue-600 dark:bg-blue-700">
            <div class="flex items-center space-x-2">
                <span class="text-3xl">🧪</span>
                <span class="text-xl font-bold text-white">ChemLab</span>
            </div>
        </div>

        <!-- User Info -->
        <div class="p-4 bg-gray-50 dark:bg-gray-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                        {{ str_replace('_', ' ', auth()->user()->role ?? 'User') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-4 px-4 space-y-2 flex-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="mr-3 text-lg">📊</span>
                Dashboard
            </a>

            <!-- Equipment Management -->
            <div x-data="{ open: false }">
                <button @click="open = !open" 
                        class="group w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <span class="mr-3 text-lg">🔬</span>
                        Equipment
                    </div>
                    <svg class="ml-auto h-4 w-4 transition-transform" :class="{ 'rotate-90': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="open" class="ml-6 mt-2 space-y-1">
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Browse Equipment
                    </a>
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        My Borrowed Items
                    </a>
                </div>
            </div>

            <!-- Loan Requests -->
            <div x-data="{ open: false }">
                <button @click="open = !open" 
                        class="group w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <span class="mr-3 text-lg">📋</span>
                        Loan Requests
                    </div>
                    <svg class="ml-auto h-4 w-4 transition-transform" :class="{ 'rotate-90': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="open" class="ml-6 mt-2 space-y-1">
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        New Request
                    </a>
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        My Requests
                    </a>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'lab_assistant')
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Pending Approvals
                    </a>
                    @endif
                </div>
            </div>

            <!-- Laboratories -->
            <a href="{{ route('laboratories.index') }}" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('laboratories.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="mr-3 text-lg">🏛️</span>
                Laboratories
            </a>

            <!-- QR Scanner -->
            <a href="#" 
               class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="mr-3 text-lg">📱</span>
                QR Scanner
            </a>

            <!-- Reports -->
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'head_of_lab')
            <div x-data="{ open: false }">
                <button @click="open = !open" 
                        class="group w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <span class="mr-3 text-lg">📈</span>
                        Reports
                    </div>
                    <svg class="ml-auto h-4 w-4 transition-transform" :class="{ 'rotate-90': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div x-show="open" class="ml-6 mt-2 space-y-1">
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Usage Reports
                    </a>
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Equipment Status
                    </a>
                    <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                        User Analytics
                    </a>
                </div>
            </div>
            @endif

            <!-- Admin Section -->
            @if(auth()->user()->role === 'admin')
            <hr class="border-gray-200 dark:border-gray-700 my-4">
            <div class="space-y-2">
                <p class="px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                    Administration
                </p>
                <a href="#" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="mr-3 text-lg">👥</span>
                    User Management
                </a>
                <a href="#" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="mr-3 text-lg">⚙️</span>
                    System Settings
                </a>
                <a href="#" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span class="mr-3 text-lg">🔒</span>
                    Audit Logs
                </a>
            </div>
            @endif
        </nav>

        <!-- Bottom Section -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <!-- Dark Mode Toggle -->
            <button @click="toggleDarkMode()" 
                    class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 mb-2">
                <span class="mr-2 text-lg">🌙</span>
                <span x-text="document.documentElement.classList.contains('dark') ? 'Light Mode' : 'Dark Mode'"></span>
            </button>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium rounded-md text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900">
                    <span class="mr-2 text-lg">🚪</span>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>