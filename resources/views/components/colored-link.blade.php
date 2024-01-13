@props([
    'href',
    'type' => 'primary'
])

@php
    $classes = [
        'primary' => 'text-primary hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600',
        'secondary' => 'text-secondary hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700 dark:text-secondary-400 dark:hover:text-secondary-500 dark:focus:text-secondary-500 dark:active:text-secondary-600',
        'success' => 'text-success hover:text-success-600 focus:text-success-600 active:text-success-700 dark:text-success-400 dark:hover:text-success-500 dark:focus:text-success-500 dark:active:text-success-600',
        'danger' => 'text-danger hover:text-danger-600 focus:text-danger-600 active:text-danger-700 dark:text-danger-400 dark:hover:text-danger-500 dark:focus:text-danger-500 dark:active:text-danger-600',
        'warning' => 'text-warning hover:text-warning-600 focus:text-warning-600 active:text-warning-700 dark:text-warning-400 dark:hover:text-warning-500 dark:focus:text-warning-500 dark:active:text-warning-600',
        'info' => 'text-info hover:text-info-600 focus:text-info-600 active:text-info-700 dark:text-info-400 dark:hover:text-info-500 dark:focus:text-info-500 dark:active:text-info-600',
        'light' => 'text-light hover:text-light-600 focus:text-light-600 active:text-light-700 dark:text-light-400 dark:hover:text-light-500 dark:focus:text-light-500 dark:active:text-light-600',
    ][$type];
@endphp

<a href="{{ $href }}"
   class="transition duration-150 ease-in-out capitalize {{ $classes }}"
>{{ $slot }}</a>
