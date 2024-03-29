<div class="post-content mx-auto my-8 lg:my-16">
    @if ($work->date_design)
        <x-attribute-with-label :label="__('works.design_year')">
            {{ $work->date_design }}
        </x-attribute-with-label>
    @endif

    @if ($work->date_construction)
        <x-attribute-with-label :label="__('works.realisation_year')">
            {{ $work->date_construction }}
        </x-attribute-with-label>
    @endif

    @if ($work->typologies->count() > 0)
        <x-attribute-with-label :label="__('works.typology')">
            @foreach ($work->typologies as $typology)
                <x-link-arrow url="{{ route('works', ['typologies[]' => $typology->name]) }}">
                    {{ $typology->name }}
                </x-link-arrow>
            @endforeach
        </x-attribute-with-label>
    @endif

    @if ($work->location)
        <x-attribute-with-label :label="__('works.address')">
            {{ $work->location }}
        </x-attribute-with-label>
    @endif

    @if ($work->awards->count() > 0 || ($work->other_awards->count() > 0))
        <x-attribute-with-label :label="__('works.awards')">
            @foreach ($work->awards as $award)
                {{ $award->name }} ({{ $award->pivot->year }}) {{ ( $award->pivot->winning) ? __('works.winning') :  __('works.nomination') }}<br>
            @endforeach
            {!! $work->other_awards->implode('name', '<br>') !!}
        </x-attribute-with-label>
    @endif

    @if (($work->architects->count() > 0) || ($work->other_architects->count() > 0))
        <x-attribute-with-label :label="__('works.authors')">
            @foreach ($work->architects as $architect)
                <x-link-architect url="{{ $architect->url }}" external>{{ $architect->full_name }}</x-link-architect>{{ ($loop->last && !($work->other_architects->count() > 0)) ? '' : ', ' }}
            @endforeach
            {{ $work->other_architects->implode('name', ', ') }}
        </x-attribute-with-label>
    @endif

    @if ($work->studio)
        <x-attribute-with-label :label="__('works.studio')">
            {{ $work->studio }}
        </x-attribute-with-label>
    @endif

    @if ($work->annotation)
        <x-attribute-with-label :label="__('works.about_the_work')">
            {!! $work->annotation !!}
        </x-attribute-with-label>
    @endif

    @if ($work->citationPublications->count() > 0 || ($work->other_publications->count() > 0))
        <x-attribute-with-label :label="__('works.citations')">
            @foreach ($work->citationPublications as $publication)
                @if ($publication->pivot->source && Str::startsWith($publication->pivot->source, 'http'))
                    <x-link-arrow url="{{ $publication->pivot->source }}" target="_blank">
                        {{ $publication->publication_name }}
                    </x-link-arrow>
                @else
                    {{ $publication->publication_name }}<br>
                @endif
            @endforeach
            {!! $work->other_publications->implode('name', '<br>') !!}
        </x-attribute-with-label>
    @endif
</div>
