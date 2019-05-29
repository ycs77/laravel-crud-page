@extends('layouts.app')

@section('content')
    <div class="container">
        @include('crud-page::alert')

        {!! form($form) !!}
    </div>
@endsection
