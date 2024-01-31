<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Fill Attendance') }}
            </h2>

            <x-colored-link
                href="{{ route('attendances.index') }}">
                index
            </x-colored-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('attendances.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')"/>
                            <x-textarea-input id="description" class="block mt-1 w-full" name="description"
                                              :value="old('description')"/>
                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="attended_at" :value="__('Attended At')"/>

                            <x-text-input id="attended_at" class="block mt-1 w-full"
                                          type="date" value="{{ old('attended_at') }}"
                                          name="attended_at"/>

                            <x-input-error :messages="$errors->get('attended_at')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-start mt-4 gap-2">
                            <x-primary-button>
                                {{ __('Submit') }}
                            </x-primary-button>

                            <label for="attended" class="inline-flex items-center">
                                <input id="attended" type="checkbox" @if(old('attended') === 'on') checked @endif
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                       name="attended">
                                <span
                                    class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Is Present') }}</span>
                                <x-input-error :messages="$errors->get('attended')" class="mt-2"/>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
