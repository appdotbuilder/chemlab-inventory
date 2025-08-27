@extends('layouts.app')

@section('title', 'Create Laboratory - ChemLab')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex items-center space-x-4 mb-8" data-aos="fade-down">
            <a href="{{ route('laboratories.index') }}" 
               class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                ← Back to Laboratories
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    ➕ Create New Laboratory
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Add a new laboratory to the system
                </p>
            </div>
        </div>

        <!-- Create Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg" data-aos="fade-up">
            <form method="POST" action="{{ route('laboratories.store') }}" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Laboratory Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required 
                               value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="e.g. Analytical Chemistry Laboratory">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Laboratory Code *</label>
                        <input type="text" 
                               id="code" 
                               name="code" 
                               required 
                               value="{{ old('code') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('code') border-red-500 @enderror"
                               placeholder="e.g. LAB-ACH-001">
                        @error('code')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror"
                               placeholder="Building name, Floor, Room number">
                        @error('location')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Capacity (people)</label>
                        <input type="number" 
                               id="capacity" 
                               name="capacity" 
                               min="1"
                               value="{{ old('capacity') }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('capacity') border-red-500 @enderror"
                               placeholder="Maximum occupancy">
                        @error('capacity')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Laboratory description, purpose, and capabilities">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                        <select id="status" 
                                name="status" 
                                required
                                class="select2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                        </select>
                        @error('status')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                        <select id="type" 
                                name="type"
                                class="select2 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                            <option value="teaching" {{ old('type', 'teaching') === 'teaching' ? 'selected' : '' }}>Teaching Lab</option>
                            <option value="research" {{ old('type') === 'research' ? 'selected' : '' }}>Research Lab</option>
                            <option value="equipment_room" {{ old('type') === 'equipment_room' ? 'selected' : '' }}>Equipment Room</option>
                            <option value="storage" {{ old('type') === 'storage' ? 'selected' : '' }}>Storage Room</option>
                        </select>
                        @error('type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" 
                            onclick="history.back()"
                            class="flex-1 px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        🏛️ Create Laboratory
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection