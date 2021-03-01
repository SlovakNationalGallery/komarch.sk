<div class="form-check pb-1">
    <input class="form-check-input" type="checkbox" value="{{ $tag->name }}" id="{{ $tag->slug }}" name="categories[]" {{ (in_array($tag->name, request('categories', [])) ? 'checked' : '' ) }}>
    <label class="form-check-label" for="{{ $tag->slug }}">
        {{ $tag->name }}
    </label>
</div>