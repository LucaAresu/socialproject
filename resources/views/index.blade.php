@extends('layouts.template')
@section('titolo','Home')

@section('content')
<h1>b {{Route::currentRouteName()}}</h1>
@dd($posts)
@endsection
