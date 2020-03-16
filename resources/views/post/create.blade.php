@extends('layouts.template')
@section('content')
    @component('components.createPost',compact('post'))
    @endcomponent
@endsection
