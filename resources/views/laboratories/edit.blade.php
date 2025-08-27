@extends('layouts.app')

@section('title', 'Edit Laboratory - ' . $laboratory->name . ' - ChemLab')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex items-center space-x-4 mb-8" data-aos="fade-down">
            <a href="{{ route('laboratories.show', $laboratory) }}" 
               class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                ← Back to Laboratory
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    ✏️ Edit Laboratory
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Update {{ $laboratory->name }} information
                </p>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg" data-aos="fade-up">
            <form method="POST" action="{{ route('laboratories.update', $laboratory) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Laboratory Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               required 
                               value="{{ old('name', $laboratory->name) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
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
                               value="{{ old('code', $laboratory->code) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('code') border-red-500 @enderror">
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
                               value="{{ old('location', $laboratory->location) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror">
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
                               value="{{ old('capacity', $laboratory->capacity) }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('capacity') border-red-500 @enderror">
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
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $laboratory->description) }}</textarea>
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
                            <option value="active" {{ old('status', $laboratory->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $laboratory->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="maintenance" {{ old('status', $laboratory->status) === 'maintenance' ? 'selected' : '' }}>Under Maintenance</option>
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
                            <option value="teaching" {{ old('type', $laboratory->type ?? 'teaching') === 'teaching' ? 'selected' : '' }}>Teaching Lab</option>
                            <option value="research" {{ old('type', $laboratory->type) === 'research' ? 'selected' : '' }}>Research Lab</option>
                            <option value="equipment_room" {{ old('type', $laboratory->type) === 'equipment_room' ? 'selected' : '' }}>Equipment Room</option>
                            <option value="storage" {{ old('type', $laboratory->type) === 'storage' ? 'selected' : '' }}>Storage Room</option>
                        </select>
                        @error('type')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('laboratories.show', $laboratory) }}" 
                       class="flex-1 px-6 py-3 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition-colors font-medium text-center">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        💾 Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        @if(auth()->user()->role === 'admin')
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg mt-8 border border-red-200 dark:border-red-800" data-aos="fade-up">
            <h3 class="text-xl font-bold text-red-600 dark:text-red-400 mb-4">⚠️ Danger Zone</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                Once you delete this laboratory, there is no going back. Please be certain.
            </p>
            <form method="POST" action="{{ route('laboratories.destroy', $laboratory) }}" 
                  onsubmit="return confirm('Are you absolutely sure? This will permanently delete the laboratory and all associated data.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        🗑️ Delete Laboratory
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection