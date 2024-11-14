@props(['status'])

@if ($status)
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 dark:bg-green-200">
        {{ $status }}
    </div>
@endif