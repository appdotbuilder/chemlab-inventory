@extends('layouts.app')

@section('title', 'ChemLab - Laboratory Equipment Management System')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="container mx-auto px-6 py-16" data-aos="fade-up">
            <div class="text-center">
                <div class="mb-8">
                    <!-- Animated Logo -->
                    <div class="mb-6" data-aos="zoom-in" data-aos-delay="200">
                        <lottie-player
                            src="https://assets9.lottiefiles.com/packages/lf20_DMgKk1.json"
                            background="transparent"
                            speed="1"
                            style="width: 120px; height: 120px; margin: 0 auto;"
                            loop
                            autoplay>
                        </lottie-player>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-4 fade-in-up">
                        🧪 <span class="text-blue-600 dark:text-blue-400">ChemLab</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8 fade-in-up" data-aos="fade-up" data-aos-delay="300">
                        Laboratory Equipment Management System
                    </p>
                    <p class="text-lg text-gray-500 dark:text-gray-400 max-w-3xl mx-auto fade-in-up" data-aos="fade-up" data-aos-delay="400">
                        Integrated system for borrowing and returning laboratory equipment for the 
                        Department of Chemical Engineering, Faculty of Engineering, University of Indonesia
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ route('login') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        🔐 Login to System
                    </a>
                    <a href="{{ route('register') }}" 
                       class="bg-white hover:bg-gray-50 text-blue-600 border-2 border-blue-600 px-8 py-3 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        📝 Student Registration
                    </a>
                </div>
            </div>

            <!-- Key Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl mb-4">📋</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Equipment Borrowing
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Submit loan requests with approval workflows, schedule validation, and JSA compliance
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl mb-4">🔬</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Equipment Inventory
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Comprehensive equipment catalog with specifications, availability, and maintenance tracking
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Lab Management
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Manage laboratory profiles, schedules, SOPs, and operational procedures
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl mb-4">📱</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        QR Check-Out/In
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Mobile-friendly handover process with QR/barcode scanning and condition tracking
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-4xl mb-4">🔔</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Real-time Notifications
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Instant alerts for approvals, due dates, overdue items, and system updates
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-4xl mb-4">📈</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        Reports & Analytics
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Comprehensive dashboards with utilization trends, exportable reports, and insights
                    </p>
                </div>
            </div>

            <!-- User Roles Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg mb-16" data-aos="fade-up" data-aos-delay="700">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">
                    👥 User Roles & Access
                </h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-3xl mb-2">👑</div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Admin</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">System management</p>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-3xl mb-2">🧬</div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Head of Lab</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Lab oversight</p>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-3xl mb-2">🔧</div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Lab Assistant</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Equipment management</p>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                        <div class="text-3xl mb-2">👨‍🏫</div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Lecturer</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Supervision & approval</p>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="500">
                        <div class="text-3xl mb-2">🎓</div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Student</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Equipment borrowing</p>
                    </div>
                </div>
            </div>

            <!-- Interactive Chart Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg mb-16" data-aos="fade-up" data-aos-delay="800">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">
                    📊 System Usage Overview
                </h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Equipment Categories</h3>
                        <canvas id="equipmentChart" width="400" height="200"></canvas>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Monthly Usage Trend</h3>
                        <canvas id="usageChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid sm:grid-cols-3 gap-8 mb-16">
                <div class="bg-blue-600 text-white rounded-xl p-6 text-center hover:bg-blue-700 transition-colors duration-300" data-aos="flip-left" data-aos-delay="100">
                    <div class="text-3xl font-bold mb-2 counter" data-target="500">0</div>
                    <div class="text-blue-100">Equipment Items</div>
                </div>
                <div class="bg-green-600 text-white rounded-xl p-6 text-center hover:bg-green-700 transition-colors duration-300" data-aos="flip-left" data-aos-delay="200">
                    <div class="text-3xl font-bold mb-2 counter" data-target="15">0</div>
                    <div class="text-green-100">Active Laboratories</div>
                </div>
                <div class="bg-purple-600 text-white rounded-xl p-6 text-center hover:bg-purple-700 transition-colors duration-300" data-aos="flip-left" data-aos-delay="300">
                    <div class="text-3xl font-bold mb-2 counter" data-target="1000">0</div>
                    <div class="text-purple-100">Registered Users</div>
                </div>
            </div>

            <!-- Sample Data Table -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg mb-16" data-aos="fade-up" data-aos-delay="900">
                <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">
                    🔬 Recent Equipment Activity
                </h2>
                <div class="overflow-x-auto">
                    <table class="data-table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Equipment</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Borrowed By</th>
                                <th scope="col" class="px-6 py-3">Due Date</th>
                                <th scope="col" class="px-6 py-3">Laboratory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Microscope XM-100</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span></td>
                                <td class="px-6 py-4">-</td>
                                <td class="px-6 py-4">-</td>
                                <td class="px-6 py-4">Lab A</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Centrifuge CF-200</td>
                                <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Borrowed</span></td>
                                <td class="px-6 py-4">John Doe</td>
                                <td class="px-6 py-4">2024-02-15</td>
                                <td class="px-6 py-4">Lab B</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Spectrometer SP-300</td>
                                <td class="px-6 py-4"><span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Overdue</span></td>
                                <td class="px-6 py-4">Jane Smith</td>
                                <td class="px-6 py-4">2024-01-30</td>
                                <td class="px-6 py-4">Lab C</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Balance AB-400</td>
                                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Maintenance</span></td>
                                <td class="px-6 py-4">-</td>
                                <td class="px-6 py-4">-</td>
                                <td class="px-6 py-4">Lab A</td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">pH Meter PM-500</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span></td>
                                <td class="px-6 py-4">-</td>
                                <td class="px-6 py-4">-</td>
                                <td class="px-6 py-4">Lab D</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="text-center" data-aos="fade-up" data-aos-delay="1000">
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    🏛️ Department of Chemical Engineering, Faculty of Engineering<br />
                    University of Indonesia
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center text-sm">
                    <a href="#faq" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 hover:underline transition-colors duration-200">
                        ❓ FAQ
                    </a>
                    <a href="#contact" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 hover:underline transition-colors duration-200">
                        📞 Contact Support
                    </a>
                    <a href="#about" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 hover:underline transition-colors duration-200">
                        ℹ️ About ChemLab
                    </a>
                </div>
            </div>
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

    // Chart.js Charts
    const ctx1 = document.getElementById('equipmentChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Microscopes', 'Centrifuges', 'Spectrometers', 'Balances', 'pH Meters', 'Others'],
            datasets: [{
                data: [45, 35, 25, 40, 30, 125],
                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#F59E0B',
                    '#EF4444',
                    '#8B5CF6',
                    '#6B7280'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15
                    }
                }
            }
        }
    });

    const ctx2 = document.getElementById('usageChart').getContext('2d');
    new Chart(ctx2, {
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
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endpush
@endsection