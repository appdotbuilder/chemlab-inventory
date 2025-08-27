@extends('layouts.app')

@section('title', 'Dashboard - ChemLab')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6 py-8">
        <!-- Welcome Header -->
        <div class="mb-8" data-aos="fade-down">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    Welcome back, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    @switch(auth()->user()->role)
                        @case('admin')
                            👑 System Administrator
                            @break
                        @case('head_of_lab')
                            🧬 Laboratory Head
                            @break
                        @case('lab_assistant')
                            🔧 Laboratory Assistant
                            @break
                        @case('lecturer')
                            👨‍🏫 Lecturer
                            @break
                        @case('student')
                            🎓 Student
                            @break
                        @default
                            👤 User
                    @endswitch
                </p>
                <div class="mt-4">
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        {{ auth()->user()->status === 'active' 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                            : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                        {{ auth()->user()->status === 'active' ? '✅ Active' : '⏳ Pending Approval' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Total Equipment
                        </p>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 counter" data-target="{{ $stats['totalEquipment'] ?? 247 }}">
                            0
                        </p>
                    </div>
                    <div class="text-4xl">🔬</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Available Equipment
                        </p>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 counter" data-target="{{ $stats['availableEquipment'] ?? 189 }}">
                            0
                        </p>
                    </div>
                    <div class="text-4xl">✅</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Active Labs
                        </p>
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 counter" data-target="{{ $stats['activeLabs'] ?? 12 }}">
                            0
                        </p>
                    </div>
                    <div class="text-4xl">🏛️</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Pending Requests
                        </p>
                        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400 counter" data-target="{{ $stats['pendingRequests'] ?? 23 }}">
                            0
                        </p>
                    </div>
                    <div class="text-4xl">⏳</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Overdue Returns
                        </p>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400 counter" data-target="{{ $stats['overdueReturns'] ?? 5 }}">
                            0
                        </p>
                    </div>
                    <div class="text-4xl">⚠️</div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Total Users
                        </p>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 counter" data-target="{{ $stats['totalUsers'] ?? 856 }}">
                            0
                        </p>
                    </div>
                    <div class="text-4xl">👥</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8" data-aos="fade-up" data-aos-delay="700">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105" 
                 onclick="showModal('New Loan Request', 'Submit a new equipment loan request')">
                <div class="flex items-center space-x-3">
                    <div class="text-3xl">📋</div>
                    <div>
                        <h3 class="font-semibold">New Loan Request</h3>
                        <p class="text-blue-100 text-sm">Submit equipment request</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105"
                 onclick="showModal('Browse Equipment', 'View all available equipment')">
                <div class="flex items-center space-x-3">
                    <div class="text-3xl">🔍</div>
                    <div>
                        <h3 class="font-semibold">Browse Equipment</h3>
                        <p class="text-green-100 text-sm">View available items</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105"
                 onclick="showModal('View Reports', 'Access analytics and reports')">
                <div class="flex items-center space-x-3">
                    <div class="text-3xl">📊</div>
                    <div>
                        <h3 class="font-semibold">View Reports</h3>
                        <p class="text-purple-100 text-sm">Analytics & insights</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105"
                 onclick="showQRModal()">
                <div class="flex items-center space-x-3">
                    <div class="text-3xl">📱</div>
                    <div>
                        <h3 class="font-semibold">QR Scanner</h3>
                        <p class="text-orange-100 text-sm">Check-in/out equipment</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Charts -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-right">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    📈 Equipment Usage Trend
                </h2>
                <canvas id="usageTrendChart" width="400" height="200"></canvas>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-left">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    🔬 Equipment by Category
                </h2>
                <canvas id="categoryChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Data Table with Equipment Status -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg mb-8" data-aos="fade-up">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    📋 Equipment Status Overview
                </h2>
                <div class="flex space-x-2">
                    <input type="date" class="date-picker px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    <select class="select2 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <option>All Labs</option>
                        <option>Lab A</option>
                        <option>Lab B</option>
                        <option>Lab C</option>
                        <option>Lab D</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Equipment ID</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Borrowed By</th>
                            <th scope="col" class="px-6 py-3">Due Date</th>
                            <th scope="col" class="px-6 py-3">Laboratory</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ001</td>
                            <td class="px-6 py-4">Microscope XM-100</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    Available
                                </span>
                            </td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">Lab A</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400">View</button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ002</td>
                            <td class="px-6 py-4">Centrifuge CF-200</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                    Borrowed
                                </span>
                            </td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">2024-02-15</td>
                            <td class="px-6 py-4">Lab B</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400">View</button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ003</td>
                            <td class="px-6 py-4">Spectrometer SP-300</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                    Overdue
                                </span>
                            </td>
                            <td class="px-6 py-4">Jane Smith</td>
                            <td class="px-6 py-4">2024-01-30</td>
                            <td class="px-6 py-4">Lab C</td>
                            <td class="px-6 py-4">
                                <button class="text-red-600 hover:text-red-900 dark:text-red-400">Alert</button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ004</td>
                            <td class="px-6 py-4">Balance AB-400</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    Maintenance
                                </span>
                            </td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">Lab A</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Schedule</button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ005</td>
                            <td class="px-6 py-4">pH Meter PM-500</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    Available
                                </span>
                            </td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">Lab D</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Reserve</button>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ006</td>
                            <td class="px-6 py-4">Rotary Evaporator RE-600</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                    Borrowed
                                </span>
                            </td>
                            <td class="px-6 py-4">Mike Johnson</td>
                            <td class="px-6 py-4">2024-02-20</td>
                            <td class="px-6 py-4">Lab C</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Extend</button>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">EQ007</td>
                            <td class="px-6 py-4">Heating Mantle HM-700</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    Available
                                </span>
                            </td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">Lab B</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Request</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                📈 Recent Activity
            </h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                    <div class="text-2xl">🔬</div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900 dark:text-white">
                            Microscope XM-100 returned
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            2 hours ago • by John Doe
                        </p>
                    </div>
                    <div class="text-sm text-green-600 dark:text-green-400 font-medium">
                        Completed
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                    <div class="text-2xl">📋</div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900 dark:text-white">
                            New loan request submitted
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            5 hours ago • by Jane Smith
                        </p>
                    </div>
                    <div class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">
                        Pending
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                    <div class="text-2xl">✅</div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900 dark:text-white">
                            Centrifuge CF-200 approved
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            1 day ago • by Lab Assistant
                        </p>
                    </div>
                    <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                        Approved
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Quick Actions -->
<div id="actionModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50" x-data="{ show: false }" x-show="show">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-md w-full mx-4" @click.away="show = false">
        <h3 id="modalTitle" class="text-2xl font-bold text-gray-900 dark:text-white mb-4"></h3>
        <p id="modalContent" class="text-gray-600 dark:text-gray-300 mb-6"></p>
        <div class="flex space-x-4">
            <button onclick="closeModal()" class="flex-1 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                Cancel
            </button>
            <button class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Continue
            </button>
        </div>
    </div>
</div>

<!-- QR Scanner Modal -->
<div id="qrModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50" x-data="{ show: false }" x-show="show">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-lg w-full mx-4" @click.away="show = false">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">📱 QR Code Scanner</h3>
        <div class="text-center mb-6">
            <div class="w-64 h-64 bg-gray-200 dark:bg-gray-700 rounded-lg mx-auto flex items-center justify-center mb-4">
                <lottie-player
                    src="https://assets2.lottiefiles.com/packages/lf20_V9t630.json"
                    background="transparent"
                    speed="1"
                    style="width: 200px; height: 200px;"
                    loop
                    autoplay>
                </lottie-player>
            </div>
            <p class="text-gray-600 dark:text-gray-300">Position QR code within the frame</p>
        </div>
        <div class="flex space-x-4">
            <button onclick="closeQRModal()" class="flex-1 px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors">
                Cancel
            </button>
            <button class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Start Scan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 1);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });

    // Usage Trend Chart
    const ctx1 = document.getElementById('usageTrendChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Equipment Usage',
                data: [120, 150, 180, 165, 200, 190],
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
            }
        }
    });

    // Category Chart
    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Microscopes', 'Centrifuges', 'Spectrometers', 'Balances', 'pH Meters'],
            datasets: [{
                data: [45, 35, 25, 40, 30],
                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#F59E0B',
                    '#EF4444',
                    '#8B5CF6'
                ],
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
});

// Modal Functions
function showModal(title, content) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalContent').textContent = content;
    document.getElementById('actionModal').classList.remove('hidden');
    document.getElementById('actionModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('actionModal').classList.add('hidden');
    document.getElementById('actionModal').classList.remove('flex');
}

function showQRModal() {
    document.getElementById('qrModal').classList.remove('hidden');
    document.getElementById('qrModal').classList.add('flex');
}

function closeQRModal() {
    document.getElementById('qrModal').classList.add('hidden');
    document.getElementById('qrModal').classList.remove('flex');
}
</script>
@endpush
@endsection