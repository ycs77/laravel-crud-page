@extends('layouts.app')

@section('content')
    <div class="container">
        @include('crud-page::alert')

        <div class="mb-3">
            @foreach($actions->get() as $key => $action)
                @if($action->displayed($crudSlug))
                    {!! $action->render($action, $crudSlug, $model->id) !!}
                @endif
            @endforeach
        </div>

        <div class="table-responsive">
            <table class="{{ config('tableView.class') }}">
                @foreach ($data as $title => $value)
                    <tr>
                        <th class="text-right" width="30%">{{ $title }}</th>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    @if ($actions->has('destroy'))
        @include('crud-page::destroy-script')
    @endif
@endsection
