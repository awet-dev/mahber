<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Update Schedule') }}
            </h2>

            <x-colored-link
                href="{{ route('schedules.index') }}">
                index
            </x-colored-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('schedules.update', ['schedule' => $schedule->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="md:flex flex-row gap-2 mb-3">
                            <div class="w-full">
                                <x-input-label for="name" :value="__('Event Name')"/>
                                <x-text-input id="name" class="block mt-1 w-full" name="name"
                                              :value="old('name', $schedule->name)" required autofocus/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>

                            <div class="w-full">
                                <x-input-label for="time" :value="__('Time')"/>
                                <x-text-input type="datetime-local" id="time" class="block mt-1 w-full" name="time"
                                              :value="old('time', $schedule->time)"/>
                                <x-input-error :messages="$errors->get('time')" class="mt-2"/>
                            </div>
                        </div>

                        <div class="md:flex flex-row gap-2 mb-3">
                            <div class="w-full">
                                <x-input-label for="user_id" :value="__('User')"/>
                                <x-select-input id="user_id" class="block mt-1 w-full" name="user_id" disabled
                                                :value="old('user_id', $schedule->user_id)" :options="$users"/>
                                <small class="text-info">Only ADMIN can update user</small>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>
                            </div>


                            <div class="w-full">
                                <x-input-label for="group" :value="__('Group')"/>
                                <x-select-input id="group" class="block mt-1 w-full" name="group"
                                                :value="old('group',  $schedule->group)" :options="$groups"/>
                                <x-input-error :messages="$errors->get('group')" class="mt-2"/>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')"/>
                            <x-textarea-input id="description" class="block mt-1 w-full" name="description"
                            >{{ old('description', $schedule->description) }}</x-textarea-input>
                            <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
