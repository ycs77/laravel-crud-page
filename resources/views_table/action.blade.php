@if ($action->url($crudSlug, $id))
    <a href="{{ $action->url($crudSlug, $id) }}" class="btn btn-{{ $action->color() }} btn-{{ $action->name() }}">
        <i class="{{ $action->icon() }}"></i>
        {{ $action->text() }}
    </a>
@else
    <button class="btn btn-{{ $action->color() }}">
        <i class="{{ $action->icon() }}"></i>
        {{ $action->text() }}
    </button>
@endif
