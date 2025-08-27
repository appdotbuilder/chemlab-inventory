import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';


interface Props {
    stats?: {
        totalEquipment: number;
        availableEquipment: number;
        activeLabs: number;
        pendingRequests: number;
        overdueReturns: number;
        totalUsers: number;
    };
    user: {
        id: number;
        name: string;
        role: string;
        status: string;
        [key: string]: unknown;
    };
}



export default function Dashboard({ stats, user }: Props) {
    const defaultStats = {
        totalEquipment: 247,
        availableEquipment: 189,
        activeLabs: 12,
        pendingRequests: 23,
        overdueReturns: 5,
        totalUsers: 856,
    };

    const dashboardStats = stats || defaultStats;

    const getRoleSpecificGreeting = (role: string) => {
        switch (role) {
            case 'admin':
                return '👑 System Administrator';
            case 'head_of_lab':
                return '🧬 Laboratory Head';
            case 'lab_assistant':
                return '🔧 Laboratory Assistant';
            case 'lecturer':
                return '👨‍🏫 Lecturer';
            case 'student':
                return '🎓 Student';
            default:
                return '👤 User';
        }
    };

    return (
        <>
            <Head title="Dashboard - ChemLab" />
            <AppShell>
                <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
                    <div className="container mx-auto px-6 py-8">
                        {/* Welcome Header */}
                        <div className="mb-8">
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <h1 className="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                    Welcome back, {user.name}! 👋
                                </h1>
                                <p className="text-lg text-gray-600 dark:text-gray-300">
                                    {getRoleSpecificGreeting(user.role)}
                                </p>
                                <div className="mt-4">
                                    <span className={`px-3 py-1 rounded-full text-sm font-medium ${
                                        user.status === 'active' 
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                            : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                    }`}>
                                        {user.status === 'active' ? '✅ Active' : '⏳ Pending Approval'}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {/* Stats Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Total Equipment
                                        </p>
                                        <p className="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                            {dashboardStats.totalEquipment}
                                        </p>
                                    </div>
                                    <div className="text-4xl">🔬</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Available Equipment
                                        </p>
                                        <p className="text-3xl font-bold text-green-600 dark:text-green-400">
                                            {dashboardStats.availableEquipment}
                                        </p>
                                    </div>
                                    <div className="text-4xl">✅</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Active Labs
                                        </p>
                                        <p className="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                            {dashboardStats.activeLabs}
                                        </p>
                                    </div>
                                    <div className="text-4xl">🏛️</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Pending Requests
                                        </p>
                                        <p className="text-3xl font-bold text-orange-600 dark:text-orange-400">
                                            {dashboardStats.pendingRequests}
                                        </p>
                                    </div>
                                    <div className="text-4xl">⏳</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Overdue Returns
                                        </p>
                                        <p className="text-3xl font-bold text-red-600 dark:text-red-400">
                                            {dashboardStats.overdueReturns}
                                        </p>
                                    </div>
                                    <div className="text-4xl">⚠️</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Total Users
                                        </p>
                                        <p className="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                            {dashboardStats.totalUsers}
                                        </p>
                                    </div>
                                    <div className="text-4xl">👥</div>
                                </div>
                            </div>
                        </div>

                        {/* Quick Actions */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div className="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-blue-600 hover:to-blue-700 transition-all duration-200">
                                <div className="flex items-center space-x-3">
                                    <div className="text-3xl">📋</div>
                                    <div>
                                        <h3 className="font-semibold">New Loan Request</h3>
                                        <p className="text-blue-100 text-sm">Submit equipment request</p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-green-600 hover:to-green-700 transition-all duration-200">
                                <div className="flex items-center space-x-3">
                                    <div className="text-3xl">🔍</div>
                                    <div>
                                        <h3 className="font-semibold">Browse Equipment</h3>
                                        <p className="text-green-100 text-sm">View available items</p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-purple-600 hover:to-purple-700 transition-all duration-200">
                                <div className="flex items-center space-x-3">
                                    <div className="text-3xl">📊</div>
                                    <div>
                                        <h3 className="font-semibold">View Reports</h3>
                                        <p className="text-purple-100 text-sm">Analytics & insights</p>
                                    </div>
                                </div>
                            </div>

                            <div className="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg cursor-pointer hover:from-orange-600 hover:to-orange-700 transition-all duration-200">
                                <div className="flex items-center space-x-3">
                                    <div className="text-3xl">📱</div>
                                    <div>
                                        <h3 className="font-semibold">QR Scanner</h3>
                                        <p className="text-orange-100 text-sm">Check-in/out equipment</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Recent Activity */}
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                            <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                                📈 Recent Activity
                            </h2>
                            <div className="space-y-4">
                                <div className="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div className="text-2xl">🔬</div>
                                    <div className="flex-1">
                                        <p className="font-medium text-gray-900 dark:text-white">
                                            Microscope XM-100 returned
                                        </p>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            2 hours ago • by John Doe
                                        </p>
                                    </div>
                                </div>

                                <div className="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div className="text-2xl">📋</div>
                                    <div className="flex-1">
                                        <p className="font-medium text-gray-900 dark:text-white">
                                            New loan request submitted
                                        </p>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            5 hours ago • by Jane Smith
                                        </p>
                                    </div>
                                </div>

                                <div className="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div className="text-2xl">✅</div>
                                    <div className="flex-1">
                                        <p className="font-medium text-gray-900 dark:text-white">
                                            Centrifuge CF-200 approved
                                        </p>
                                        <p className="text-sm text-gray-600 dark:text-gray-300">
                                            1 day ago • by Lab Assistant
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </AppShell>
        </>
    );
}