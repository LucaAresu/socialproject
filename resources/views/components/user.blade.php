@if($user)
    @component('components.avatar', compact('user'))
        <a href="{{route('user_post',compact('user'))}}">{{$user->name}}</a>
        {{$slot}}
    @endcomponent
@else
    DELETED
@endif
