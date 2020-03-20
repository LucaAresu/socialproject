@extends('layouts.template')

@section('titolo', 'Notifiche')

@section('content')

    <div class="border bg-white py-2">
    @component('components.notifiche.show',compact('notifications'))
    @endcomponent
    </div>
@endsection
