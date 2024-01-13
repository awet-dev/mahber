<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Payments') }}
            </h2>

            <x-colored-link
                href="{{ route('users.payments.create', ['user' => $user->id]) }}">
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
                            <x-table-th>Amount Paid</x-table-th>
                            <x-table-th>Amount left/back</x-table-th>
                            <x-table-th>Create At</x-table-th>
                            <x-table-th>Update At</x-table-th>
                            <x-table-th>Actions</x-table-th>
                        </x-slot>

                        <x-slot name="table_tr">
                            @foreach($payments as $payment)
                                <x-table-tr>
                                    <x-slot name="table_td">
                                        <x-table-td>{{ $payment->amount_paid }}</x-table-td>
                                        <x-table-td class="flex gap-1">
                                            @if($payment->amount_left)
                                                <x-check-icon/>
                                                {{ $payment->amount_left }}
                                            @elseif($payment->amount_back)
                                                <x-xmark-icon/>
                                                {{ $payment->amount_back }}
                                            @else
                                                <x-dash-icon/>
                                                @money(0)
                                            @endif
                                        </x-table-td>
                                        <x-table-td>{{ $payment->created_at->toDateString() }}</x-table-td>
                                        <x-table-td>{{ $payment->updated_at->diffForHumans() }}</x-table-td>
                                        <x-table-td>
                                            <x-colored-link
                                                href="{{ route('users.payments.edit', ['user' => $user->id, 'payment' => $payment->id]) }}">
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
