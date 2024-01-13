<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Attendances') }}
            </h2>

            <x-colored-link
                href="{{ route('attendances.create') }}">
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
                            <x-table-th>Attended</x-table-th>
                            <x-table-th>Attended At</x-table-th>
                            <x-table-th>Created At</x-table-th>
                            <x-table-th>Update At</x-table-th>
                            <x-table-th>Actions</x-table-th>
                        </x-slot>

                        <x-slot name="table_tr">
                            @foreach($attendances as $attendance)
                                <x-table-tr>
                                    <x-slot name="table_td">
                                        <x-table-td>
                                            @if($attendance->attended)
                                                <x-check-icon/>
                                            @else
                                                <x-xmark-icon/>
                                            @endif
                                        </x-table-td>
                                        <x-table-td>{{ $attendance->attended_at->toDateString() }}</x-table-td>
                                        <x-table-td>{{ $attendance->created_at->toDateString() }}</x-table-td>
                                        <x-table-td>{{ $attendance->updated_at->diffForHumans() }}</x-table-td>
                                        <x-table-td>
                                            <x-colored-link
                                                href="{{ route('attendances.edit', ['attendance' => $attendance->id]) }}">
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
