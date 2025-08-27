import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

export default function Welcome() {
    return (
        <>
            <Head title="ChemLab - Laboratory Equipment Management System" />
            <AppShell>
                <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                    {/* Hero Section */}
                    <div className="relative overflow-hidden">
                        <div className="container mx-auto px-6 py-16">
                            <div className="text-center">
                                <div className="mb-8">
                                    <h1 className="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-4">
                                        🧪 <span className="text-blue-600 dark:text-blue-400">ChemLab</span>
                                    </h1>
                                    <p className="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-8">
                                        Laboratory Equipment Management System
                                    </p>
                                    <p className="text-lg text-gray-500 dark:text-gray-400 max-w-3xl mx-auto">
                                        Integrated system for borrowing and returning laboratory equipment for the 
                                        Department of Chemical Engineering, Faculty of Engineering, University of Indonesia
                                    </p>
                                </div>

                                {/* CTA Buttons */}
                                <div className="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                                    <Link 
                                        href="/login" 
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition-colors duration-200"
                                    >
                                        🔐 Login to System
                                    </Link>
                                    <Link 
                                        href="/register" 
                                        className="bg-white hover:bg-gray-50 text-blue-600 border-2 border-blue-600 px-8 py-3 rounded-lg font-semibold text-lg transition-colors duration-200"
                                    >
                                        📝 Student Registration
                                    </Link>
                                </div>
                            </div>

                            {/* Key Features Grid */}
                            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                    <div className="text-4xl mb-4">📋</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Equipment Borrowing
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Submit loan requests with approval workflows, schedule validation, and JSA compliance
                                    </p>
                                </div>

                                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                    <div className="text-4xl mb-4">🔬</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Equipment Inventory
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Comprehensive equipment catalog with specifications, availability, and maintenance tracking
                                    </p>
                                </div>

                                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                    <div className="text-4xl mb-4">📊</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Lab Management
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Manage laboratory profiles, schedules, SOPs, and operational procedures
                                    </p>
                                </div>

                                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                    <div className="text-4xl mb-4">📱</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        QR Check-Out/In
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Mobile-friendly handover process with QR/barcode scanning and condition tracking
                                    </p>
                                </div>

                                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                    <div className="text-4xl mb-4">🔔</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Real-time Notifications
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Instant alerts for approvals, due dates, overdue items, and system updates
                                    </p>
                                </div>

                                <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                    <div className="text-4xl mb-4">📈</div>
                                    <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                        Reports & Analytics
                                    </h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Comprehensive dashboards with utilization trends, exportable reports, and insights
                                    </p>
                                </div>
                            </div>

                            {/* User Roles Section */}
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg mb-16">
                                <h2 className="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">
                                    👥 User Roles & Access
                                </h2>
                                <div className="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">
                                    <div className="text-center">
                                        <div className="text-3xl mb-2">👑</div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Admin</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">System management</p>
                                    </div>
                                    <div className="text-center">
                                        <div className="text-3xl mb-2">🧬</div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Head of Lab</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">Lab oversight</p>
                                    </div>
                                    <div className="text-center">
                                        <div className="text-3xl mb-2">🔧</div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Lab Assistant</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">Equipment management</p>
                                    </div>
                                    <div className="text-center">
                                        <div className="text-3xl mb-2">👨‍🏫</div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Lecturer</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">Supervision & approval</p>
                                    </div>
                                    <div className="text-center">
                                        <div className="text-3xl mb-2">🎓</div>
                                        <h4 className="font-semibold text-gray-900 dark:text-white">Student</h4>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">Equipment borrowing</p>
                                    </div>
                                </div>
                            </div>

                            {/* Quick Stats */}
                            <div className="grid sm:grid-cols-3 gap-8 mb-16">
                                <div className="bg-blue-600 text-white rounded-xl p-6 text-center">
                                    <div className="text-3xl font-bold mb-2">500+</div>
                                    <div className="text-blue-100">Equipment Items</div>
                                </div>
                                <div className="bg-green-600 text-white rounded-xl p-6 text-center">
                                    <div className="text-3xl font-bold mb-2">15</div>
                                    <div className="text-green-100">Active Laboratories</div>
                                </div>
                                <div className="bg-purple-600 text-white rounded-xl p-6 text-center">
                                    <div className="text-3xl font-bold mb-2">1000+</div>
                                    <div className="text-purple-100">Registered Users</div>
                                </div>
                            </div>

                            {/* Footer Info */}
                            <div className="text-center">
                                <p className="text-gray-500 dark:text-gray-400 mb-4">
                                    🏛️ Department of Chemical Engineering, Faculty of Engineering<br />
                                    University of Indonesia
                                </p>
                                <div className="flex flex-col sm:flex-row gap-4 justify-center text-sm">
                                    <Link href="/faq" className="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                        ❓ FAQ
                                    </Link>
                                    <Link href="/contact" className="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                        📞 Contact Support
                                    </Link>
                                    <Link href="/about" className="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                        ℹ️ About ChemLab
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </AppShell>
        </>
    );
}