<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>

            <x-colored-link
                href="{{ route('users.create') }}">
                create
            </x-colored-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-table>
                        <x-slot name="table_th">
                            <x-table-th>Name</x-table-th>
                            <x-table-th>Email</x-table-th>
                            <x-table-th>Verified At</x-table-th>
                            <x-table-th>Created At</x-table-th>
                            <x-table-th>Update At</x-table-th>
                            <x-table-th>Actions</x-table-th>
                        </x-slot>

                        <x-slot name="table_tr">
                            @foreach($users as $user)
                                <x-table-tr>
                                    <x-slot name="table_td">
                                        <x-table-td class="flex gap-1">
                                            {{ $user->name }}
                                        </x-table-td>
                                        <x-table-td>{{ $user->email }}</x-table-td>
                                        <x-table-td class="flex gap-1">
                                            @if($user->email_verified_at)
                                                <x-check-icon/>
                                                {{ $user->email_verified_at->toDateString() }}
                                            @else
                                                <x-xmark-icon/>
                                                Not verified
                                            @endif
                                        </x-table-td>
                                        <x-table-td>{{ $user->created_at->toDateString() }}</x-table-td>
                                        <x-table-td>{{ $user->updated_at->diffForHumans() }}</x-table-td>
                                        <x-table-td>
                                            <x-colored-link
                                                href="{{ route('users.edit', ['user' => $user->id]) }}">
                                                edit
                                            </x-colored-link>
                                        </x-table-td>
                                    </x-slot>
                                </x-table-tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
