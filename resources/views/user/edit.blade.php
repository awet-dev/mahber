<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User detail') }}
            </h2>

            <x-colored-link
                href="{{ route('users.index') }}">
                index
            </x-colored-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('users.update', ['user' => $user]) }}" id="update-user-form">
                        @method('PUT')
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                          :value="old('name', $user->name)" required autofocus autocomplete="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                          :value="old('email', $user->email)" required autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                    </form>

                    <div class="flex items-center justify-end mt-4">
                        @if(!$user->hasVerifiedEmail())
                            <form method="POST"
                                  action="{{ route('users.request_email_verification', ['user' => $user->id]) }}">
                                @csrf

                                <div>
                                    <x-primary-button>
                                        {{ __('Resend Verification Email') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        @endif

                        <x-primary-button id="update-user-btn" class="ms-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const update_user_btn = document.getElementById('update-user-btn')
        update_user_btn.addEventListener('click', function () {
            const form = document.getElementById('update-user-form');
            form.submit();
        })
    </script>
</x-app-layout>
