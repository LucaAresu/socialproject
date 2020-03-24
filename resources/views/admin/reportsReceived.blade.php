@extends('admin.template.template')
@section('content')
    <h1>Reports fatti a {{$user->name}}</h1>
    <table class="table table-bordered bg-white text">
        <thead>
        <tr>
            <th>Tipo</th>
            <th>ID</th>
            <th>Numero Report</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reports as $report)
            <tr>
                <td>{{$report->tipo}}</td>
                <td>
                    <a href="{{route('check_report',['tipo'=>str_replace('App\\','',$report->tipo), 'id'=> $report->id ])}}">
                        {{$report->id}}
                    </a>
                </td>
                <td>{{$report->count}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No reports</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
