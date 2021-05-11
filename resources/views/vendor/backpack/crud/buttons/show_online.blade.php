@if ($crud->hasAccess('show'))
<a href="{{ $entry->url }}" class="btn btn-sm btn-link" target="_blank"><i class="la la-globe"></i> Show online</a>
@endif
