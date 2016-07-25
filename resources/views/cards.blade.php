@extends('layout')

@section('content')
        @foreach($cards as $card)
            <div class="wrap">
                @include('card', ['card' => $card])
            </div>
        @endforeach
@endsection