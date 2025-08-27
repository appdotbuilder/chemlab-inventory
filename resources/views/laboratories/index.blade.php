@extends('layouts.app')

@section('title', 'Laboratories - ChemLab')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    🏛️ Laboratory Management
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Manage laboratory profiles, schedules, and equipment
                </p>
            </div>
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'head_of_lab')
            <button onclick="showCreateLabModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 flex items-center space-x-2">
                <span class="text-lg">➕</span>
                <span>Add Laboratory</span>
            </button>
            @endif
        </div>

        <!-- Laboratory Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Labs</p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $laboratories->count() }}</p>
                    </div>
                    <div class="text-4xl">🏛️</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Active Labs</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $laboratories->where('status', 'active')->count() }}</p>
                    </div>
                    <div class="text-4xl">✅</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Equipment</p>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">
                            {{ $laboratories->sum(function($lab) { return $lab->equipment_count ?? 0; }) }}
                        </p>
                    </div>
                    <div class="text-4xl">🔬</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Utilization</p>
                        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">85%</p>
                    </div>
                    <div class="text-4xl">📊</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg mb-8" data-aos="fade-up" data-aos-delay="500">
            <div class="grid md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                    <input type="text" placeholder="Search laboratories..." 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select class="select2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Maintenance</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                    <select class="select2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option>All Types</option>
                        <option>Teaching Lab</option>
                        <option>Research Lab</option>
                        <option>Equipment Room</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors duration-200">
                        🔍 Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Laboratory Cards Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($laboratories as $index => $laboratory)
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" 
                 data-aos="fade-up" data-aos-delay="{{ ($index % 3 + 1) * 100 }}">
                <!-- Lab Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-white text-xl font-bold">
                            {{ substr($laboratory->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $laboratory->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $laboratory->code }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded-full text-xs font-medium 
                        {{ $laboratory->status === 'active' 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ ucfirst($laboratory->status) }}
                    </span>
                </div>

                <!-- Lab Info -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <span class="w-5 text-center mr-2">📍</span>
                        <span>{{ $laboratory->location ?? 'Location not set' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <span class="w-5 text-center mr-2">👥</span>
                        <span>Capacity: {{ $laboratory->capacity ?? 'Not specified' }}</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <span class="w-5 text-center mr-2">🔬</span>
                        <span>{{ $laboratory->equipment_count ?? 0 }} Equipment</span>
                    </div>
                </div>

                <!-- Lab Description -->
                @if($laboratory->description)
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6 line-clamp-3">
                    {{ Str::limit($laboratory->description, 120) }}
                </p>
                @endif

                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">{{ rand(5, 15) }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Active Loans</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-semibold text-green-600 dark:text-green-400">{{ rand(80, 95) }}%</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Availability</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-semibold text-purple-600 dark:text-purple-400">{{ rand(20, 50) }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Users</div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('laboratories.show', $laboratory) }}" 
                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        👁️ View Details
                    </a>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'head_of_lab')
                    <button onclick="showEditLabModal({{ $laboratory->id }})" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        ✏️
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12" data-aos="fade-up">
                <div class="text-6xl mb-4">🏛️</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Laboratories Found</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">Get started by adding your first laboratory.</p>
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'head_of_lab')
                <button onclick="showCreateLabModal()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
                    ➕ Add Laboratory
                </button>
                @endif
            </div>
            @endforelse
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                📋 Recent Laboratory Activity
            </h2>
            <div class="overflow-x-auto">
                <table class="data-table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Laboratory</th>
                            <th scope="col" class="px-6 py-3">Activity</th>
                            <th scope="col" class="px-6 py-3">User</th>
                            <th scope="col" class="px-6 py-3">Time</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Analytical Chemistry Lab</td>
                            <td class="px-6 py-4">Equipment check-out: Spectrometer SP-300</td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">2 hours ago</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    Completed
                                </span>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Organic Synthesis Lab</td>
                            <td class="px-6 py-4">Equipment return: Rotary Evaporator</td>
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">4 hours ago</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    Processing
                                </span>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Physical Chemistry Lab</td>
                            <td class="px-6 py-4">Maintenance scheduled: pH Meter calibration</td>
                            <td class="px-6 py-4">Lab Assistant</td>
                            <td class="px-6 py-4">1 day ago</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                    Scheduled
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Laboratory Modal -->
<div id="createLabModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50" x-data="{ show: false }" x-show="show">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-2xl w-full mx-4 max-h-screen overflow-y-auto" @click.away="show = false">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">➕ Add New Laboratory</h3>
        <form class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Laboratory Name *</label>
                    <input type="text" required 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Laboratory Code *</label>
                    <input type="text" required placeholder="e.g. LAB-001" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
                    <input type="text" placeholder="Building, Room number" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Capacity</label>
                    <input type="number" placeholder="Maximum occupancy" 
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                    <select class="select2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option>Teaching Lab</option>
                        <option>Research Lab</option>
                        <option>Equipment Room</option>
                        <option>Storage Room</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select class="select2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="maintenance">Under Maintenance</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                <textarea rows="4" placeholder="Laboratory description and purpose..." 
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>
            
            <div class="flex space-x-4">
                <button type="button" onclick="closeCreateLabModal()" 
                        class="flex-1 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Create Laboratory
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showCreateLabModal() {
    document.getElementById('createLabModal').classList.remove('hidden');
    document.getElementById('createLabModal').classList.add('flex');
}

function closeCreateLabModal() {
    document.getElementById('createLabModal').classList.add('hidden');
    document.getElementById('createLabModal').classList.remove('flex');
}

function showEditLabModal(labId) {
    // Implementation for editing laboratory
    console.log('Edit lab:', labId);
}
</script>
@endpush
@endsection