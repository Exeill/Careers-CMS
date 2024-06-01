@props(['status'])

<div class="w-full mb-5 flex flex-col">
    @include(static::$headerView)
    <div
        data-status-id="{{ $status['id'] }}"
        class="flex flex-row w-full gap-2 p-3  dark:bg-gray-800 rounded-xl"
    >
    
        @foreach($status['records'] as $record)
            @include(static::$recordView)
        @endforeach
    </div>
</div>

