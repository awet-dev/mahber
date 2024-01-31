<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Schedules') }}
            </h2>

            <x-colored-link
                href="{{ route('admin.schedules.create') }}">
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
                            <x-table-th>Group</x-table-th>
                            <x-table-th>Time</x-table-th>
                            <x-table-th>Updated At</x-table-th>
                            <x-table-th>Actions</x-table-th>
                        </x-slot>

                        <x-slot name="table_tr">
                            @foreach($schedules as $schedule)
                                <x-table-tr>
                                    <x-slot name="table_td">
                                        <x-table-td>{{ $schedule->name }}</x-table-td>
                                        <x-table-td>{{ $schedule->group }}</x-table-td>
                                        <x-table-td>{{ $schedule->time->toDateString() }}</x-table-td>
                                        <x-table-td>{{ $schedule->updated_at->diffForHumans() }}</x-table-td>
                                        <x-table-td>
                                            <form method="post"
                                                  action="{{ route('admin.schedules.destroy', ['schedule' => $schedule->id]) }}"
                                                  class="p-6">
                                                @csrf
                                                @method('delete')

                                                <div class="flex gap-3">
                                                    <x-colored-link
                                                        href="{{ route('admin.schedules.edit', ['schedule' => $schedule->id]) }}">
                                                        edit
                                                    </x-colored-link>

                                                    <button type="submit">
                                                        <x-xmark-icon/>
                                                    </button>

                                                </div>
                                            </form>
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
