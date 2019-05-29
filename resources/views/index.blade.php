@extends('layouts.app')

@section('content')
    <div class="container">
        @include('crud-page::alert')

        <div class="mb-3">
            @if($createAction->displayed($crudSlug))
                {!! $createAction->render($createAction, $crudSlug) !!}
            @endif
        </div>

        {!! $table->render() !!}
    </div>
@endsection
