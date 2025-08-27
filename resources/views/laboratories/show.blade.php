@extends('layouts.app')

@section('title', $laboratory->name . ' - ChemLab')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div class="flex items-center space-x-4">
                <a href="{{ route('laboratories.index') }}" 
                   class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                    ← Back to Laboratories
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        🏛️ {{ $laboratory->name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">
                        Laboratory Code: {{ $laboratory->code }}
                    </p>
                </div>
            </div>
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'head_of_lab')
            <div class="flex space-x-3">
                <button onclick="showEditLabModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 flex items-center space-x-2">
                    <span>✏️</span>
                    <span>Edit Lab</span>
                </button>
                <button onclick="showAddEquipmentModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200 flex items-center space-x-2">
                    <span>➕</span>
                    <span>Add Equipment</span>
                </button>
            </div>
            @endif
        </div>

        <!-- Laboratory Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg mb-8" data-aos="fade-up">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Lab Avatar and Basic Info -->
                <div class="text-center lg:text-left">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-3xl font-bold mx-auto lg:mx-0 mb-4">
                        {{ substr($laboratory->name, 0, 1) }}
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $laboratory->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $laboratory->code }}</p>
                    <span class="px-4 py-2 rounded-full text-sm font-medium 
                        {{ $laboratory->status === 'active' 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                        {{ ucfirst($laboratory->status) }}
                    </span>
                </div>

                <!-- Lab Details -->
                <div class="lg:col-span-2">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <span class="w-6 text-center mr-3 text-lg">📍</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</p>
                                    <p>{{ $laboratory->location ?? 'Not specified' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <span class="w-6 text-center mr-3 text-lg">👥</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Capacity</p>
                                    <p>{{ $laboratory->capacity ?? 'Not specified' }} people</p>
                                </div>
                            </div>

                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <span class="w-6 text-center mr-3 text-lg">🔬</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Equipment</p>
                                    <p>{{ $laboratory->equipment ? $laboratory->equipment->count() : 0 }} items</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <span class="w-6 text-center mr-3 text-lg">📅</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</p>
                                    <p>{{ $laboratory->created_at?->format('M d, Y') ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <span class="w-6 text-center mr-3 text-lg">📊</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Utilization</p>
                                    <p>{{ rand(75, 95) }}% average</p>
                                </div>
                            </div>

                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                <span class="w-6 text-center mr-3 text-lg">⏰</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Operating Hours</p>
                                    <p>08:00 - 17:00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($laboratory->description)
                    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Description</p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $laboratory->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Equipment</p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">
                            {{ $laboratory->equipment ? $laboratory->equipment->count() : 0 }}
                        </p>
                    </div>
                    <div class="text-4xl">🔬</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Available</p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                            {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'available')->count() : 0 }}
                        </p>
                    </div>
                    <div class="text-4xl">✅</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">In Use</p>
                        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">
                            {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'borrowed')->count() : 0 }}
                        </p>
                    </div>
                    <div class="text-4xl">🔄</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Maintenance</p>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">
                            {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'maintenance')->count() : 0 }}
                        </p>
                    </div>
                    <div class="text-4xl">🔧</div>
                </div>
            </div>
        </div>

        <!-- Equipment Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg mb-8" data-aos="fade-up" data-aos-delay="500">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">📊 Equipment Usage Overview</h3>
            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <canvas id="equipmentStatusChart" width="400" height="200"></canvas>
                </div>
                <div>
                    <canvas id="usageHistoryChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Equipment List -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="600">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">🔬 Equipment Inventory</h3>
                <div class="flex space-x-3">
                    <select class="select2 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                        <option>All Status</option>
                        <option>Available</option>
                        <option>Borrowed</option>
                        <option>Maintenance</option>
                    </select>
                    <input type="text" placeholder="Search equipment..." 
                           class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                </div>
            </div>

            @if($laboratory->equipment && $laboratory->equipment->count() > 0)
            <div class="overflow-x-auto">
                <table class="data-table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Equipment ID</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Condition</th>
                            <th scope="col" class="px-6 py-3">Last Maintenance</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laboratory->equipment as $equipment)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $equipment->code ?? 'EQ' . str_pad($equipment->id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">{{ $equipment->name }}</td>
                            <td class="px-6 py-4">{{ $equipment->category ?? 'General' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded text-xs font-medium
                                    {{ $equipment->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                                    {{ $equipment->status === 'borrowed' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                    {{ $equipment->status === 'maintenance' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                                    {{ $equipment->status === 'retired' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}">
                                    {{ ucfirst($equipment->status ?? 'available') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    {{ $equipment->condition ?? 'Good' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $equipment->last_maintenance_at?->format('M d, Y') ?? 'Never' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="viewEquipment({{ $equipment->id }})" 
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 text-xs">
                                        View
                                    </button>
                                    @if($equipment->status === 'available')
                                    <button onclick="requestEquipment({{ $equipment->id }})" 
                                            class="text-green-600 hover:text-green-900 dark:text-green-400 text-xs">
                                        Request
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔬</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Equipment Found</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">This laboratory doesn't have any equipment yet.</p>
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'head_of_lab')
                <button onclick="showAddEquipmentModal()" 
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
                    ➕ Add Equipment
                </button>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Equipment Details Modal -->
<div id="equipmentModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50" x-data="{ show: false }" x-show="show">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-2xl w-full mx-4 max-h-screen overflow-y-auto" @click.away="show = false">
        <h3 id="equipmentTitle" class="text-2xl font-bold text-gray-900 dark:text-white mb-6"></h3>
        <div id="equipmentDetails" class="space-y-4">
            <!-- Equipment details will be loaded here -->
        </div>
        <div class="flex space-x-4 mt-6">
            <button onclick="closeEquipmentModal()" 
                    class="flex-1 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                Close
            </button>
            <button id="equipmentActionBtn" 
                    class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Request Equipment
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Equipment Status Chart
    const ctx1 = document.getElementById('equipmentStatusChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'In Use', 'Maintenance', 'Retired'],
            datasets: [{
                data: [
                    {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'available')->count() : 0 }},
                    {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'borrowed')->count() : 0 }},
                    {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'maintenance')->count() : 0 }},
                    {{ $laboratory->equipment ? $laboratory->equipment->where('status', 'retired')->count() : 0 }}
                ],
                backgroundColor: ['#10B981', '#F59E0B', '#EF4444', '#6B7280'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Usage History Chart
    const ctx2 = document.getElementById('usageHistoryChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Equipment Usage',
                data: [{{ rand(10, 50) }}, {{ rand(10, 50) }}, {{ rand(10, 50) }}, {{ rand(10, 50) }}, {{ rand(10, 50) }}, {{ rand(10, 50) }}],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});

// Modal Functions
function showEditLabModal() {
    console.log('Edit lab modal');
}

function showAddEquipmentModal() {
    console.log('Add equipment modal');
}

function viewEquipment(equipmentId) {
    document.getElementById('equipmentTitle').textContent = 'Equipment Details';
    document.getElementById('equipmentDetails').innerHTML = `
        <p class="text-gray-600 dark:text-gray-300">Loading equipment details for ID: ${equipmentId}...</p>
    `;
    document.getElementById('equipmentModal').classList.remove('hidden');
    document.getElementById('equipmentModal').classList.add('flex');
}

function requestEquipment(equipmentId) {
    console.log('Request equipment:', equipmentId);
}

function closeEquipmentModal() {
    document.getElementById('equipmentModal').classList.add('hidden');
    document.getElementById('equipmentModal').classList.remove('flex');
}
</script>
@endpush
@endsection