@extends('layouts.template')
@section('content')
    <div class="row">
    @forelse($fols as $fol)
        <div class="col-4">
            @component('components.profilecard',['user' =>$fol])
            @endcomponent
        </div>
@empty
        Non c'è nulla!
    @endforelse
    </div>
@endsection
