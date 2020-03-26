@extends('admin.template.template')

@section('content')
    <table class="table bg-white table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Ban</th>
            <th>Email</th>
            <th>Numero Post</th>
            <th>Numero Commenti</th>
            <th>Segnalazioni Ricevute</th>
            <th>Segnalazioni Fatte</th>
        </tr>
        </thead>
        <tbody>
    @forelse($users as $user)
        @php
        $u = \App\User::withTrashed()->find($user->id);
        @endphp
                <tr>
                    <td><a href="{{route('user_post',compact('user'))}}">{{$user->name}}</a></td>

                    <td>
                        @if(!$u->isAdmin())
                            <form action="{{route('admin_ban')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                @if($u->trashed())
                                    <button class="btn btn-primary">Restore</button>
                                @else
                                    <button class="btn btn-danger">Ban</button>
                                @endif
                            </form>
                        @endif

                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->posts()->count()}}</td>
                    <td>{{$user->comments()->count()}}</td>
                    <td>
                        <a href="{{route('admin_report_ricevuti',compact('user'))}}">
                            {{$user->reportsReceived()->count()}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('admin_report_fatti',compact('user'))}}">
                            {{$user->reportsDone()->count()}}
                        </a>
                    </td>
                </tr>
    @empty
        <td colspan="5">Non ci sono utenti</td>
    @endforelse
        </tbody>
    </table>
    {{$users->links()}}
@endsection
