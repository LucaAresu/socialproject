@extends('layouts.template')

@section('titolo', 'Notifiche')

@section('content')

    <div class="border bg-white p-2 mb-2">
        <h3 class="text-center">Notifiche non lette</h3>
    @component('components.notifiche.show',['notifications' => $unread])
    @endcomponent
    </div>

    <div class="border bg-white p-2">
        <h3 class="text-center">Vecchie notifiche</h3>
        @component('components.notifiche.show',['notifications' => $read])
        @endcomponent
    </div>
@endsection
