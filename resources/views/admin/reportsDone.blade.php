@extends('admin.template.template')
@section('content')
    <div class="container">
        <h1>Reports fatti da @component('components.user',compact('user')) @endcomponent</h1>
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Report Subiti</th>
                </tr>
            </thead>
            <tbody>
            @forelse($reports as $report)
                <tr>
                    <td><a href="{{route('user_post',['user' => $report->id])}}"> {{$report->name}} </a></td>
                    <td><a href="{{route('admin_report_ricevuti', ['user' => $report->id])}}">{{$report->totali}}</a></td>
                </tr>
            @empty
                <tr><td colspan="2">Questo utente non ha fatto report</td> </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
