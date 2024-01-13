<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Payment') }}
            </h2>

            <x-colored-link
                href="{{ route('users.payments.index', ['user' => $user->id]) }}">
                index
            </x-colored-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('users.payments.store', ['user' => $user->id]) }}">
                        @csrf

                        <!-- Amount Paid -->
                        <div>
                            <x-input-label for="amount_paid" :value="__('Amount Paid')"/>
                            <x-text-input id="amount_paid" class="block mt-1 w-full" name="amount_paid"
                                          :value="old('amount_paid')" required autofocus/>
                            <x-input-error :messages="$errors->get('amount_paid')" class="mt-2"/>
                        </div>

                        <!-- Amount Left -->
                        <div>
                            <x-input-label for="amount_left" :value="__('Amount Left')"/>
                            <x-text-input id="amount_left" class="block mt-1 w-full" name="amount_left"
                                          :value="old('amount_left')"/>
                            <x-input-error :messages="$errors->get('amount_left')" class="mt-2"/>
                        </div>

                        <!-- Amount Return -->
                        <div>
                            <x-input-label for="amount_back" :value="__('Amount Back')"/>
                            <x-text-input id="amount_return" class="block mt-1 w-full" name="amount_back"
                                          :value="old('amount_back')"/>
                            <x-input-error :messages="$errors->get('amount_back')" class="mt-2"/>
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
