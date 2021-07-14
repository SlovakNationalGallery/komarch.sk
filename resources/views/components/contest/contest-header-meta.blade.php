<div class="flex flex-wrap items-center">

    @if ($contest->announced_at)
    <span class="whitespace-nowrap">
        @if ($contest->finished_at)
            {{ $contest->announced_at->format(config('settings.date_short_without_year_format')) }} – {{ $contest->finished_at->format(config('settings.date_short_format')) }}
        @else
            {{ $contest->announced_at->format(config('settings.date_short_format')) }}
        @endif
    </span>
    @endif


    <span class="ml-2 lg:ml-10">
        @if($contest->finished_at)
            <span class="icon-clock mr-1" />
            <span title="{{ $contest->finished_at->format(config('settings.date_short_format')) }}">
                {!! $contest->finished_at->diffForHumans() !!}
            </span>
        @endif
    </span>
</div>
