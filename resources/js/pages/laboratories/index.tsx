import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Laboratory {
    id: number;
    name: string;
    code: string;
    description: string;
    location: string;
    capacity: number;
    status: string;
    equipment_count?: number;
    contact_person: string;
    contact_email: string;
    image_gallery?: string[];
}

interface Props {
    laboratories: {
        data: Laboratory[];
        links: unknown[];
        meta: unknown;
    };
    [key: string]: unknown;
}

export default function LaboratoriesIndex({ laboratories }: Props) {
    const getStatusBadge = (status: string) => {
        const statusConfig = {
            active: { bg: 'bg-green-100 text-green-800', text: '🟢 Active' },
            inactive: { bg: 'bg-gray-100 text-gray-800', text: '⚫ Inactive' },
            maintenance: { bg: 'bg-orange-100 text-orange-800', text: '🔧 Maintenance' },
        };
        
        return statusConfig[status as keyof typeof statusConfig] || statusConfig.active;
    };

    return (
        <>
            <Head title="Laboratories - ChemLab" />
            <AppShell>
                <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
                    <div className="container mx-auto px-6 py-8">
                        {/* Header */}
                        <div className="mb-8">
                            <div className="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                                        🏛️ Laboratories
                                    </h1>
                                    <p className="text-lg text-gray-600 dark:text-gray-300">
                                        Manage laboratory facilities and information
                                    </p>
                                </div>
                                <div className="mt-4 md:mt-0">
                                    <Link
                                        href="/laboratories/create"
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center space-x-2"
                                    >
                                        <span>➕</span>
                                        <span>Add New Laboratory</span>
                                    </Link>
                                </div>
                            </div>
                        </div>

                        {/* Stats Overview */}
                        <div className="grid md:grid-cols-4 gap-6 mb-8">
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Total Labs
                                        </p>
                                        <p className="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                            {laboratories.data.length}
                                        </p>
                                    </div>
                                    <div className="text-4xl">🏛️</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Active Labs
                                        </p>
                                        <p className="text-3xl font-bold text-green-600 dark:text-green-400">
                                            {laboratories.data.filter(lab => lab.status === 'active').length}
                                        </p>
                                    </div>
                                    <div className="text-4xl">✅</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Under Maintenance
                                        </p>
                                        <p className="text-3xl font-bold text-orange-600 dark:text-orange-400">
                                            {laboratories.data.filter(lab => lab.status === 'maintenance').length}
                                        </p>
                                    </div>
                                    <div className="text-4xl">🔧</div>
                                </div>
                            </div>

                            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                            Total Capacity
                                        </p>
                                        <p className="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                            {laboratories.data.reduce((sum, lab) => sum + lab.capacity, 0)}
                                        </p>
                                    </div>
                                    <div className="text-4xl">👥</div>
                                </div>
                            </div>
                        </div>

                        {/* Laboratory Grid */}
                        {laboratories.data.length === 0 ? (
                            <div className="bg-white dark:bg-gray-800 rounded-xl p-12 shadow-lg text-center">
                                <div className="text-6xl mb-4">🏛️</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                    No Laboratories Found
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300 mb-6">
                                    Get started by adding your first laboratory facility.
                                </p>
                                <Link
                                    href="/laboratories/create"
                                    className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center space-x-2"
                                >
                                    <span>➕</span>
                                    <span>Add First Laboratory</span>
                                </Link>
                            </div>
                        ) : (
                            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {laboratories.data.map((lab) => {
                                    const statusConfig = getStatusBadge(lab.status);
                                    return (
                                        <div
                                            key={lab.id}
                                            className="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-200"
                                        >
                                            {/* Lab Image */}
                                            <div className="h-48 bg-gradient-to-br from-blue-400 to-blue-600 relative">
                                                {lab.image_gallery && lab.image_gallery[0] ? (
                                                    <img
                                                        src={lab.image_gallery[0]}
                                                        alt={lab.name}
                                                        className="w-full h-full object-cover"
                                                    />
                                                ) : (
                                                    <div className="w-full h-full flex items-center justify-center text-white">
                                                        <div className="text-center">
                                                            <div className="text-6xl mb-2">🏛️</div>
                                                            <p className="text-lg font-semibold">{lab.code}</p>
                                                        </div>
                                                    </div>
                                                )}
                                                <div className="absolute top-4 right-4">
                                                    <span className={`px-3 py-1 rounded-full text-sm font-medium ${statusConfig.bg}`}>
                                                        {statusConfig.text}
                                                    </span>
                                                </div>
                                            </div>

                                            {/* Lab Info */}
                                            <div className="p-6">
                                                <div className="mb-4">
                                                    <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-1">
                                                        {lab.name}
                                                    </h3>
                                                    <p className="text-sm font-medium text-blue-600 dark:text-blue-400">
                                                        {lab.code}
                                                    </p>
                                                </div>

                                                <p className="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                                                    {lab.description}
                                                </p>

                                                <div className="space-y-2 mb-4">
                                                    <div className="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                        <span className="mr-2">📍</span>
                                                        <span>{lab.location}</span>
                                                    </div>
                                                    <div className="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                        <span className="mr-2">👥</span>
                                                        <span>Capacity: {lab.capacity} people</span>
                                                    </div>
                                                    {lab.contact_person && (
                                                        <div className="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                            <span className="mr-2">👤</span>
                                                            <span>{lab.contact_person}</span>
                                                        </div>
                                                    )}
                                                </div>

                                                <div className="flex space-x-2">
                                                    <Link
                                                        href={`/laboratories/${lab.id}`}
                                                        className="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-center font-medium transition-colors duration-200"
                                                    >
                                                        View Details
                                                    </Link>
                                                    <Link
                                                        href={`/laboratories/${lab.id}/edit`}
                                                        className="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg text-center font-medium transition-colors duration-200"
                                                    >
                                                        Edit
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    );
                                })}
                            </div>
                        )}
                    </div>
                </div>
            </AppShell>
        </>
    );
}